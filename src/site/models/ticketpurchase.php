<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelTicketPurchase extends SwaModelList {

	/**
	 * @return JTable|mixed
	 */
	public function getMember() {
		if ( !isset( $this->member ) ) {
			// Create a new query object.
			$db = $this->getDbo();
			$query = $db->getQuery( true );
			$user = JFactory::getUser();

			// Select the required fields from the table.
			$query->select( 'a.*' );
			$query->from( $db->quoteName( '#__swa_member' ) . ' AS a' );
			$query->where( 'a.user_id = ' . $user->id );
			$query->group( 'a.id' );

			// Join on committee table
			$query->leftJoin( '#__swa_committee as committee on committee.member_id = a.id' );
			$query->select( '!ISNULL(committee.id) as swa_committee' );

			// Join onto the university_member table
			$query->leftJoin(
				$db->quoteName( '#__swa_university_member' ) . ' AS b ON a.id = b.member_id'
			);
			$query->select( 'b.graduated as graduated' );
			$query->select( 'count( b.id ) as confirmed_university' );
			$query->select( 'b.committee as club_committee' );

			// Get qualification info
			$subQuery = $db->getQuery( true );
			$subQuery->select( 'COUNT(*)' );
			$subQuery->from( $db->quoteName( '#__swa_qualification' ) . ' AS qualification' );
			$subQuery->where( 'qualification.member_id = b.member_id' );
			$subQuery->where( 'qualification.expiry_date > NOW()' );
			$subQuery->where( 'qualification.approved=1' );
			$query->select( '(' . $subQuery->__toString() . ') as qualification' );

			// Get event ids registered for!
			$query->join(
				'LEFT',
				'#__swa_event_registration AS event_registration ON event_registration.member_id = a.id'
			);
			$query->select(
				'GROUP_CONCAT( DISTINCT event_registration.event_id ) as registered_event_ids'
			);

			// Get event ids for tickets we have that are in the future
			$query->join( 'LEFT', '#__swa_ticket AS ticket ON ticket.member_id = a.id' );
			$query->join(
				'LEFT',
				'#__swa_event_ticket AS event_ticket ON ticket.event_ticket_id = event_ticket.id'
			);
			$query->join( 'LEFT', '#__swa_event AS event ON event_ticket.event_id = event.id' );
			$query->select(
				'GROUP_CONCAT( CASE WHEN event.date > NOW() THEN event_ticket.event_id END ) as ticketed_event_ids'
			);

			// Load the result
			$db->setQuery( $query );
			$this->member = $db->loadObject();
		}

		return $this->member;
	}

	public function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery( true );

		// Select all event tickets
		$query->select( 'event_ticket.id AS id' );
		$query->select( 'event_ticket.name AS ticket_name' );
		$query->select( 'event_ticket.price AS price' );
		$query->select( 'event_ticket.notes AS notes' );
		$query->select( 'event_ticket.need_level AS need_level' );
		$query->select( 'event_ticket.need_xswa AS need_xswa' );
		$query->select( 'event_ticket.need_swa AS need_swa' );
		$query->select( 'event_ticket.need_host AS need_host' );
		$query->select( 'event_ticket.need_qualification AS need_qualification' );
		$query->select( 'event_ticket.details AS details' );

		$query->select( 'event.id AS event_id' );
		$query->select( 'event.name AS event_name' );
		$query->select( 'event.date AS event_date' );
		$query->select( 'event.date_open AS ticket_open' );
		$query->select( 'event.date_close AS ticket_close' );
		$query->select( 'event.capacity AS event_capacity' );
		$query->select( 'event_ticket.quantity AS ticket_quantity' );
		$query->select( 'COUNT(ticket.id) AS tickets_sold' );
		$query->select( 'GROUP_CONCAT( DISTINCT event_host.university_id ) AS host_university_ids' );

		$query->from( '#__swa_event_ticket AS event_ticket' );
		$query->innerJoin( '#__swa_event AS event ON event_ticket.event_id = event.id' );
		$query->leftJoin( '#__swa_event_host AS event_host ON event_host.event_id = event.id' );
		$query->leftJoin( '#__swa_ticket AS ticket ON ticket.event_ticket_id = event_ticket.id' );

		$query->where( 'event.date > NOW()' );
		$query->group( 'id' );
		$query->order('event_id ASC', 'id ASC');

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );

		$tickets = parent::getItems();

		$member = $this->getMember();

		$allowedTickets = array();
		$totalTicketsSold = array();

		// count total number of tickets sold
		foreach ($tickets as $ticket) {
			@$totalTicketsSold[$ticket->event_id] += $ticket->tickets_sold;
		}

		foreach ($tickets as $ticket) {
			// decode the json ticket details
			$ticket->details = json_decode($ticket->details);
			if ($ticket->details === null){
				$ticket->details = new stdClass();
			}

			// get whether the ticket should displayed and the reason it can't be bought if there is one
			list($displayTicket, $ticket->reason) = $this->memberAllowedToViewBuyTicket( $member, $ticket );

			// if the event capacity is full display SOLD OUT message
			if ($totalTicketsSold[$ticket->event_id] >= $ticket->event_capacity) {
				$ticket->reason = 'Event currently SOLD OUT!';
			}

			// Only display tickets the member are allowed to see
			if ( $displayTicket ) {
				$allowedTickets[] = $ticket;
			}
		}

		return $allowedTickets;
	}

	/**
	 * Should the given user be allowed to view and buy the given ticket?
	 *
	 * Note: This could easily be tested at some point...
	 *
	 * @param object $member
	 * @param object $ticket
	 *
	 * @return array(bool, string) array($display, $reason)
	 */
	private function memberAllowedToViewBuyTicket( $member, $ticket ) {
		
		$display = true;
		$reason = array();

		$isRegisteredForEvent = ( in_array( $ticket->event_id, explode( ',', $member->registered_event_ids ) ) );
		
		// specifiy a timezone in code incase the server time is wrong
		$timezone = new DateTimeZone('Europe/London');
		$dateNow = new DateTime('now', $timezone);
		$ticketOpen = new DateTime($ticket->ticket_open, $timezone);
		$ticketClose = new DateTime($ticket->ticket_close, $timezone);
		// ticket sales close at midnight of the chosen day (hence the setTime)
		$ticketClose->setTime(23, 59, 59);
		
		
		// Check if the ticket should be displayed
		if ( !isset($ticket->details->visible) ) {
			$ticket->details->visible = "All";
		} elseif ( $ticket->details->visible == "None" ) {
			$reason = 'No one can see this ticket';
			$display = false;
			return array($display, $reason);
		} elseif ( $ticket->details->visible == "Committee" && !$member->swa_committee ) {
			$reason = 'You have to be SWA committee to see this ticket';
			$display = false;
			return array($display, $reason);
		} elseif ( $ticket->need_swa && !$member->swa_committee ) {
			// TODO delete when no longer using these fields
			$reason = 'You have to be SWA committee to buy this ticket';
			$display = false;
			return array($display, $reason);
		} 
		
		// Check if any constraints on member whitelist
		if (!empty($ticket->details->member->whitelist) &&
			!in_array($member->id, $ticket->details->member->whitelist)) {
			$reason = "This ticket is only available for specific members.";

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		}

		// Check if any constraints on member blacklist
		if (!empty($ticket->details->member->blacklist) &&
			in_array($member->id, $ticket->details->member->blacklist)) {
			$reason = "This ticket is only available for specific members.";

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		} 
		
		// Check if any constraints on university whitelist
		if (!empty($ticket->details->university->whitelist) &&
			!in_array($member->university_id, $ticket->details->university->whitelist)) {
			$reason = "This ticket is only available for specific universities.";

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		}

		// Check if any constraints on university blacklist
		if (!empty($ticket->details->university->blacklist) &&
			in_array($member->university_id, $ticket->details->university->blacklist)) {
			$reason = "This ticket is only available for specific universities.";

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		}
				
		// Check if any constraints on member's level
		if (!empty($ticket->details->level->whitelist) &&
			!in_array($member->level, $ticket->details->level->whitelist)) {
			$reason = 'You need to be one of the following levels ['; 
			$reason .= implode(', ', $ticket->details->level->whitelist) . ']';

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		} 
		
		if (!empty($ticket->details->level->blacklist) &&
			in_array($member->level, $ticket->details->level->blacklist)) {
			$reason = "You can't be one of the following levels ["; 
			$reason .= implode(', ', $ticket->details->level->blacklist) . ']';

			// don't display if visible is set to "Match" and member is not committee
			if ($ticket->details->visible == "Match" && !$member->swa_committee) {
				$display = false;
				return array($display, $reason);
			}
		}
		
		// check if member has already bought a ticket to that event
		if ( in_array($ticket->event_id, explode( ',', $member->ticketed_event_ids )) ) {
			$reason = 'You have already bought a ticket to this event';
		} elseif ( $dateNow < strtotime($ticket->ticket_open) ) {
			$reason = 'Tickets sales haven\'t opened yet';
		} elseif ( $dateNow > strtotime($ticket->ticket_close) + 24*60*60 ) {
			$reason = 'SALES CLOSED!';
		} elseif ( $ticket->ticket_quantity <= $ticket->tickets_sold ) {
			$reason = 'Ticket currently SOLD OUT!';
		} elseif ( $member->graduated && !$ticket->details->xswa ) {
			$reason = "This ticket is not available to XSWA members."
		} elseif ( !$member->graduated && !$member->swa_committee && !$isRegisteredForEvent ) {
			// Allow XSWA and SWA to buy tickets when not registered for the event
			$reason = 'You have not been registered for this event by your club committee!';
		} elseif ( $ticket->details->qualification && !member->qualification ) {
			$reason = "You need to have an approved qualification to buy this ticket";
		} elseif ( $ticket->need_qualification && !$member->qualification ) {
			// TODO delete when no longer using these fields
			$reason = "You need to have an approved qualification to buy this ticket";
		}

		return array($display, $reason);
	}

}
