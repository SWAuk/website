<?php
/*
This payment process is based off the 'Custom Payment Flow' at the following stipe site.
https://stripe.com/docs/payments/accept-a-payment?integration=elements

A tutorial is available here (at the time of writing):
https://stripe.com/docs/payments/integration-builder
*/

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerTicketPurchase extends SwaController
{

	public function select()
	{
		// $app      = JFactory::getApplication();
		$ticketId = $this->input->getString('ticketId');
		// $app->setUserState("com_swa.ticketpurchase.ticket_id", $ticketId);

		$this->setRedirect(JRoute::_('index.php?option=com_swa&layout=terms&ticketId=' . $ticketId, false));
	}

	public function createPaymentIntent()
	{
		$app = JFactory::getApplication();
		$jinput = $this->input->json;
		// Get values from fetch body
		$selectedAddons = $jinput->get('addons', array(), 'array');
		$ticketId = $jinput->get('ticketId', "", 'string');
		$estimatedPrice = $jinput->get('estimatedPrice', 0, 'float');

		// Initialise useful variables
		$model   = $this->getModel('ticketpurchase');
		$tickets = $model->getItems();
		$member  = $model->getMember();
		$user    = JFactory::getUser();

		// Make sure the member was successfully retrieved
		if (!$member || !isset($member->id) || !ctype_digit($member->id)) {
			$message = "Unable to identify member. " . var_export($member, true);
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Unable to identify member. Please contact webmaster@swa.co.uk if this problem continues.";
			echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
			jexit();
		}

		// Get the ticket the user wants to buy by matching the form data with the tickets available
		$ticket = null;

		foreach ($tickets as $t) {
			if ($t->id == $ticketId) {
				$ticket = $t;
				break;
			}
		}

		// Make sure the we managed to find the ticket
		if ($ticket == null) {
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

		// Create the class that will later be converted to json to be stored in the database
		$details         = new stdClass;
		$details->addons = array();

		// Calculate price and add addons to ticket details
		$ticketAddons   = $ticket->details->addons;
		$totalCost = $ticket->price;

		foreach ($ticketAddons as $addonId => $ticketAddon) {
			if (array_key_exists($addonId, $selectedAddons))
			{
				if (empty($selectedAddons[$addonId])) {
					// Array empty or does not exist
					continue;
				}
				$addon = $selectedAddons[$addonId];
				$addonQty = $addon["qty"];
				$addonOption = $addon["option"];
				// Make sure to use the price from the server side as the client side could be altered
				$addonPrice = $ticketAddon->price;
				$addonName = $ticketAddon->name;

				// Check for errors in addon details
				if ($addon["id"] != $addonId || $addon["name"] != $ticketAddon->name || $addon["price"] != $ticketAddon->price) {
					$message = "Unable to match the selected addons to ticket addons";
					JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
					$error_msg = "There was a problem matching the selected addons to ticket addons. \nPlease contact webmaster@swa.co.uk if this continues to happen.";
					echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
					jexit();
				}
				$totalCost += $addonPrice * $addonQty;
				// Create addon details which will be converted to json and stored in the database
				$details->addons[$addonName] = array("id" => $addonId, "name" => $addonName, "qty" => $addonQty, "option" => $addonOption, "price" => $addonPrice);
			}
		}

		$totalCost = round($totalCost, 2);
		// Check the calculated price on the front end matches that on the backend, so customers don't pay an unexpected amount
		if ($totalCost != round($estimatedPrice, 2)) {
			$message = "Cost displayed did not match cost calculated from raw ticket";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Cost displayed did not match cost calculated from raw ticket. \nPlease contact webmaster@swa.co.uk if this continues to happen";
			echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
			jexit();
		}

		if ($totalCost > 0) {
			$this->payWithStripe($user, $member, $ticket, $totalCost, $details);
		}
		else {
			// In future, could call addTicketToDb() direcrtly at this point to prevent having to send detais to stripe.
			// Would then need to send a different http code so this could be handled on the front end as well
			$message = "Attempted to buy 0 GBP ticket";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Ticket price is zero. This is not currently supported. Please contact webmaster@swa.co.uk if you are receiving this message.";
			echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
			jexit();
		}

		$app->close();

		// $this->setMessage('Ticket purchased!', 'success');
		// $this->setRedirect(JRoute::_('index.php?option=com_swa&view=membertickets'));
	}

	private function payWithStripe($user, $member, $ticket, $totalCost, $details)
	{
		$details = json_encode($details, JSON_UNESCAPED_SLASHES);
		try {
			$paymentIntent = \Stripe\PaymentIntent::create([
				'description'          => $ticket->event_name . ' - ' . $ticket->ticket_name,
				// Stripe amount is in pence
				'amount'               => $totalCost * 100,
				'currency'             => 'GBP',
				'receipt_email'        => $user->email,
				'statement_descriptor' => "SWA Ticket {$ticket->id}",
				'metadata'             => array(
					'event_ticket_id' => $ticket->id,
					'member_id'       => $member->id,
					'user_id'         => $member->user_id,
					'name'            => $user->name,
					'username'        => $user->username,
					'details'         => $details
				)
			]);
			$output = [
				'clientSecret' => $paymentIntent->client_secret,
			];
			echo new \Joomla\CMS\Response\JsonResponse($output);
		}
		catch (Error $e) {
			$message = "Member tried to buy a ticket but the paymentIntent was not created successfully: {$e->getMessage()}";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
			jexit();
		}
	}

	private function checkUniqueTicket($memberId, $eventTicketId)
	{
		// Make sure the member does not have this event ticket already
		// This is a dumb check and can be removed once we actually store transaction IDS and things
		$app = JFactory::getApplication();
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('COUNT(*)');
		$query->from($db->quoteName('#__swa_ticket') . ' as ticket');
		$query->where('ticket.member_id = ' . $db->quote($memberId));
		$query->where('ticket.event_ticket_id = ' . $db->quote($eventTicketId));
		$db->setQuery($query);
		$count = $db->loadResult();

		if ($count === null) {
			JLog::add("Unable to check if member already has ticket.", JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			echo new \Joomla\CMS\Response\JsonResponse(null, $error_msg, true);
			jexit();
		}

		if ($count >= 1) {
			JLog::add("Member {$memberId} already has a ticket to this event.", JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "You have already bought a ticket to this event! View it in Account>My Tickets. \r\n
			Contact webmaster@swa.co.uk if there is a problem.";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}
	}

	public function addTicketToDb()
	{
		$app = JFactory::getApplication();
		$jinput = $this->input->json;
		$paymentIntentId = $jinput->get('paymentIntentId', "", 'string');
		$paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

		if ($paymentIntent->status != 'succeeded') {
			$message = "PaymentIntent creation did not succeed or is still processing and so the user was prevented from 
			completing payment. You should check this payment and the database to make sure the user was not charged
			 and a ticket was not bought";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Unknown error. You should not have been charged. \r\nPlease contact webmaster@swa.co.uk
			for assistance and to confirm no payment has been taken. Do not try again.";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		};

		$memberId = $paymentIntent->metadata->member_id;
		$eventTicketId = $paymentIntent->metadata->event_ticket_id;
		$totalCost = $paymentIntent->amount;
		$details = $paymentIntent->metadata->details;

		// Add the ticket to the db
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->insert($db->quoteName('#__swa_ticket'));
		$query->columns($db->quoteName(array('member_id', 'event_ticket_id', 'paid', 'details')));
		$query->values(
			"{$db->quote($memberId)}, " .
				"{$db->quote($eventTicketId)}, " .
				// Stripe amount is in pence
				"{$db->quote($totalCost / 100)}, " .
				"{$db->quote($details)}"
		);

		$db->setQuery($query);
		$result = $db->execute();

		if ($result === false) {
			JLog::add(
				"Ticket paid for but failed to add ticket db. Member ID: {$memberId}. 
				Event Ticket ID: {$eventTicketId}. Details: {$details}",
				JLog::ERROR,
				'com_swa.payment_process'
			);
			$error_msg = "Oops! There was an error  - DO NOT try again!\r\n";
			$error_msg .= "Ticket was not purchased but a payment MAY have been taken.\r\n";
			$error_msg .= "Please contact webmaster@swa.co.uk ASAP to resolve this.\r\n";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}
		$this->logAuditFrontend('Member ' . $memberId . ' bought event ticket ' . $eventTicketId);
		echo new \Joomla\CMS\Response\JsonResponse(null);
		jexit();
	}
}
