<?php

defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';
require_once JPATH_COMPONENT . '/assets/stripe-config.php';

class SwaControllerTicketPurchase extends SwaController {

	public function select() {
		$app = JFactory::getApplication();
		$jinput = $app->input;
		$option = $jinput->get('option');
		$ticketId = $this->input->getString('ticketId');
		$app->setUserState("$option.ticket_id", $ticketId);

		$this->setRedirect( JRoute::_('index.php?option=com_swa&layout=terms') );
	}

	public function submit()
	{
		// get the POST data
		$token = $this->input->getString('stripeToken');
		$ticketId = $this->input->getString('ticketId');
		$tshirt_size = $this->input->getString('tshirt_size');

		// create the class that will later be converted to json to be stored in the database
		$details = new stdClass();
		$details->tshirt_size = $tshirt_size;

		// initialise useful variables
		$model = $this->getModel('ticketpurchase');
		$tickets = $model->getItems();
		$member = $model->getMember();
		$user = JFactory::getUser();
		
		// make sure the member was successfully retrieved
		if ( !$member || !isset($member->id) || !ctype_digit($member->id) ) {
			$message = "Unable to identify member. " . var_export($member, true);
			JLog::add( $message, JLog::ERROR, 'com_swa.payment_process' );
			die("Unable to identify user. Please contact webmaster@swa.co.uk if this problem continues.");
		}

		// get the ticket the user wants to buy by matching the form data with the tickets available
		$ticket = null;
		foreach ($tickets as $t) {
			if ($t->id == $ticketId) {
				$ticket = $t;
				break;
			}
		}

		$this->checkUniqueTicket($member->id, $ticket->id);

		// make sure the we managed to find the ticket
		if ($ticket != null) {
			try {
				$charge = \Stripe\Charge::create(
					array(
						'description' => $ticket->event_name . ' - ' . $ticket->ticket_name,
						'amount' => $ticket->price * 100,
						'currency' => 'GBP',
						'receipt_email' => $user->email,
						'statement_descriptor' => "SWA Ticket {$ticket->id}",
						'source' => $token,
						'metadata' => array(
							'event_ticket_id' => $ticket->id,
							'member_id' => $member->id,
							'user_id' => $member->user_id,
							'user_name' => $user->name
						)
					)
				);
			} catch(\Stripe\Error\Card $e) {
				// Card declined
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				die("You're card was declined. Please contact webmaster@swa.co.uk if this continues to happen.");
			} catch (\Stripe\Error\RateLimit $e) {
				// Too many requests made to the API too quickly
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "This event is in high demand and we were unable to process your payment at this time";
				$error_msg .= " - try again later. \r\nPlease contact webmaster@swa.co.uk if this continues to happen.";
				die($error_msg);
			} catch (\Stripe\Error\InvalidRequest $e) {
				// Invalid parameters were supplied to Stripe's API
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! We sent the wrong data to our payment provider.\r\n";
				$error_msg .= "Please contact webmaster@swa.co.uk to tell them they screwed up.\r\n";
				$error_msg .= "Don't worry, your card has not been charged.";
				die($error_msg);
			} catch (\Stripe\Error\Authentication $e) {
				// Authentication with Stripe's API failed (maybe you changed API keys recently)
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! We were unable to authenticate with our payment provider. ";
				$error_msg .= "Please contact webmaster@swa.co.uk and tell them they screwed up.\r\n";
				die($error_msg);
			} catch (\Stripe\Error\ApiConnection $e) {
				// Network communication with Stripe failed
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! There was a network communication error - please try again.\r\n";
				$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
				die($error_msg);
			} catch (\Stripe\Error\Base $e) {
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
				$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
				die($error_msg);
			} catch (Exception $e) {
				JLog::add( $e->getMessage(), JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
				$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
				die($error_msg);
			}

			// do some sense checking to make sure the payment didn't fail - probably not needed
			if ($charge->failure_code != null and $charge->failure_message != null
				and $charge->paid != true and $charge->captured != true) {
				JLog::add( "Stripe charge didn't return successful.", JLog::ERROR, 'com_swa.payment_process' );
				$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
				$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
				die($error_msg);
			}

			// assign ticket to member
			$this->addTicketToDb($member->id, $ticket->id, $charge, $details);

		} else {
			JLog::add("Unable to find ticket with id \"{$ticketId}\"", JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.\r\n";
			die($error_msg);
		}

		$this->setRedirect( JRoute::_( 'index.php?option=com_swa&view=membertickets' ) );
	}

	// TODO: Do we need this?
	private function checkUniqueTicket($memberId, $eventTicketId) {
		// Make sure the member does not have this event ticket already
		// This is a dumb check and can be removed once we actually store transaction IDS and things
		$db = JFactory::getDbo();
		$query = $db->getQuery( true );
		$query->select( 'COUNT(*)' );
		$query->from( $db->quoteName( '#__swa_ticket' ) . ' as ticket' );
		$query->where( 'ticket.member_id = ' . $db->quote( $memberId ) );
		$query->where( 'ticket.event_ticket_id = ' . $db->quote( $eventTicketId ) );
		$db->setQuery( $query );
		$count = $db->loadResult();

		if ( $count === null ) {
			JLog::add( "Unable to check if member already has ticket.", JLog::ERROR, 'com_swa.payment_process' );
			$error_msg = "Oops! There was an unknown error processing your transaction - please try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			die($error_msg);
		}
		if( $count >= 1 ) {
			JLog::add( "Member {$memberId} already has a ticket to this event.", JLog::ERROR, 'com_swa.payment_process' );
			die("You have already bought a ticket to this event.");
		}
	}

	private function addTicketToDb($memberId, $eventTicketId, $charge, $details) {
		// Add the ticket to the db
		$db = JFactory::getDbo();
		$query = $db->getQuery( true );
		$query->insert( $db->quoteName( '#__swa_ticket' ) );
		$query->columns( $db->quoteName( array( 'member_id', 'event_ticket_id', 'paid', 'details' ) ) );
		$query->values(
			"{$db->quote($memberId)}, " .
			"{$db->quote($eventTicketId)}, " .
			"{$db->quote($charge->amount/100.0)}, ".
			"{$db->quote(json_encode($details))}"
		);
		$db->setQuery( $query );
		$result = $db->execute();

		if ( $result === false ) {
			JLog::add(
				"Ticket paid for but failed to add ticket db. Charge ID: {$charge->id}",
				JLog::ERROR,
				'com_swa.payment_process'
			);
			$error_msg = "Oops! There was an error  - DO NOT try again!\r\n";
			$error_msg .= "Please contact webmaster@swa.co.uk ASAP to resolve this.\r\n";
			die($error_msg);
		}

		$this->logAuditFrontend( 'Member ' . $memberId . ' bought event ticket ' . $eventTicketId );
	}

}
