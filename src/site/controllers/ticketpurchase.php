<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerTicketPurchase extends SwaController
{

	public function select()
	{
		$app      = JFactory::getApplication();
		$ticketId = $this->input->getString('ticketId');
		$app->setUserState("com_swa.ticketpurchase.ticket_id", $ticketId);

		$this->setRedirect(JRoute::_('index.php?option=com_swa&layout=terms'));
	}

	public function submit()
	{
		$app      = JFactory::getApplication();
		$ticketId = $app->getUserState("com_swa.ticketpurchase.ticket_id");

		// Create the class that will later be converted to json to be stored in the database
		$details         = new stdClass;
		$details->addons = array();

		// Initialise useful variables
		$model   = $this->getModel('ticketpurchase');
		$tickets = $model->getItems();
		$member  = $model->getMember();
		$user    = JFactory::getUser();

		// Make sure the member was successfully retrieved
		if (!$member || !isset($member->id) || !ctype_digit($member->id))
		{
			$message = "Unable to identify member. " . var_export($member, true);
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			die("Unable to identify member. Please contact webmaster@swa.co.uk if this problem continues.");
		}

		// Get the ticket the user wants to buy by matching the form data with the tickets available
		$ticket = null;

		foreach ($tickets as $t)
		{
			if ($t->id == $ticketId)
			{
				$ticket = $t;
				break;
			}
		}

		// Make sure the we managed to find the ticket
		if ($ticket == null)
		{
			JLog::add(
				"Unable to find ticket with id \"{$ticketId}\" - redirecting to ticketpurchase page",
				JLog::INFO,
				'com_swa.payment_process'
			);

			$this->setMessage('Payment failed because the session expired - please try again.', 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_swa&view=ticketpurchase'));

			return;
		}

		$this->checkUniqueTicket($member->id, $ticket->id);

		$ticketAddons   = $ticket->details->addons;
		$selectedAddons = new JInput($this->input->get('addons', array(), 'ARRAY'));

		$totalCost = $ticket->price;
		foreach ($ticketAddons as $key => $ticketAddon)
		{
			$selectedAddon = new JInput($selectedAddons->get($key, array(), 'ARRAY'));

			$addonQty  = $selectedAddon->getInt('qty');
			$totalCost += $ticketAddon->price * $addonQty;

			// Create addon details which will be converted to json and stored in the database
			$details->addons[$ticketAddon->name] = array("qty" => $addonQty, "price" => $ticketAddon->price);

			// If this addon is chosen and the addon has an option add it to the details object
			if ($addonQty > 0 && isset($ticketAddon->options) && !empty($ticketAddon->options))
			{
				$details->addons[$ticketAddon->name]["option"] = $selectedAddon->getString('option');
			}
		}

		if ($totalCost > 0) {
			$this->payWithStripe($user, $member, $ticket, $totalCost);
		}

		// Assign ticket to member
		$this->addTicketToDb($member->id, $ticket->id, $totalCost, $details);

		// Clear the ticket_id from the session
		$app->setUserState("com_swa.ticketpurchase.ticket_id", null);

		$this->setMessage('Ticket purchased!', 'success');
		$this->setRedirect('account/my-tickets');
	}

	private function payWithStripe($user, $member, $ticket, $totalCost) {
		// Get the token from POST data
		$token = $this->input->getString('stripeToken');

		try
		{
			$charge = \Stripe\Charge::create(
				array(
					'description'          => $ticket->event_name . ' - ' . $ticket->ticket_name,
					// Stripe amount is in pence
					'amount'               => $totalCost * 100,
					'currency'             => 'GBP',
					'receipt_email'        => $user->email,
					'statement_descriptor' => "SWA Ticket {$ticket->id}",
					'source'               => $token,
					'metadata'             => array(
						'event_ticket_id' => $ticket->id,
						'member_id'       => $member->id,
						'user_id'         => $member->user_id,
						'user_name'       => $user->name
					)
				)
			);
		}
		catch (\Stripe\Error\Card $e)
		{
			// Card declined
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			die("Your card was declined. Please contact webmaster@swa.co.uk if this continues to happen.");
		}
		catch (\Stripe\Error\RateLimit $e)
		{
			// Too many requests made to the API too quickly
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "This event is in high demand and we were unable to process your payment at this time";
			$error_msg .= " - try again later. \r\nPlease contact webmaster@swa.co.uk if this continues to happen.";
			die($error_msg);
		}
		catch (\Stripe\Error\InvalidRequest $e)
		{
			// Invalid parameters were supplied to Stripe's API
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! We sent the wrong data to our payment provider.\r\n";
			$error_msg .= "Please contact webmaster@swa.co.uk to tell them they screwed up.\r\n";
			$error_msg .= "Don't worry, your card has not been charged.";
			die($error_msg);
		}
		catch (\Stripe\Error\Authentication $e)
		{
			// Authentication with Stripe's API failed (maybe you changed API keys recently)
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! We were unable to authenticate with our payment provider. ";
			$error_msg .= "Please contact webmaster@swa.co.uk and tell them they screwed up.\r\n";
			die($error_msg);
		}
		catch (\Stripe\Error\ApiConnection $e)
		{
			// Network communication with Stripe failed
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was a network communication error - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
			die($error_msg);
		}
		catch (\Stripe\Error\Base $e)
		{
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
			die($error_msg);
		}
		catch (Exception $e)
		{
			JLog::add($e->getMessage(), JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
			die($error_msg);
		}

		// Do some sense checking to make sure the payment didn't fail - probably not needed
		if ($charge->failure_code != null && $charge->failure_message != null
			&& $charge->paid != true && $charge->captured != true)
		{
			JLog::add("Stripe charge didn't return successful.", JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			die($error_msg);
		}
	}

	// TODO: Do we need this?
	private function checkUniqueTicket($memberId, $eventTicketId)
	{
		// Make sure the member does not have this event ticket already
		// This is a dumb check and can be removed once we actually store transaction IDS and things
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('COUNT(*)');
		$query->from($db->quoteName('#__swa_ticket') . ' as ticket');
		$query->where('ticket.member_id = ' . $db->quote($memberId));
		$query->where('ticket.event_ticket_id = ' . $db->quote($eventTicketId));
		$db->setQuery($query);
		$count = $db->loadResult();

		if ($count === null)
		{
			JLog::add("Unable to check if member already has ticket.", JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			die($error_msg);
		}

		if ($count >= 1)
		{
			JLog::add("Member {$memberId} already has a ticket to this event.", JLog::ERROR, 'com_swa.payment_process');
			die("You have already bought a ticket to this event.");
		}
	}

	private function addTicketToDb($memberId, $eventTicketId, $totalCost, $details)
	{
		$details = json_encode($details, JSON_UNESCAPED_SLASHES);

		// Add the ticket to the db
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->insert($db->quoteName('#__swa_ticket'));
		$query->columns($db->quoteName(array('member_id', 'event_ticket_id', 'paid', 'details')));
		$query->values(
			"{$db->quote($memberId)}, " .
			"{$db->quote($eventTicketId)}, " .
			// Stripe amount is in pence
			"{$db->quote($totalCost)}, " .
			"{$db->quote($details)}"
		);

		$db->setQuery($query);
		$result = $db->execute();

		if ($result === false)
		{
			JLog::add(
				"Ticket paid for but failed to add ticket db. Member ID: {$memberId}. 
				Event Ticket ID: {$eventTicketId}. Details: {$details}",
				JLog::ERROR,
				'com_swa.payment_process'
			);
			$error_msg = "Oops! There was an error  - DO NOT try again!\r\n";
			$error_msg .= "Please contact webmaster@swa.co.uk ASAP to resolve this.\r\n";
			die($error_msg);
		}

		$this->logAuditFrontend('Member ' . $memberId . ' bought event ticket ' . $eventTicketId);
	}

}
