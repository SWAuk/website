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

		$query->select( 'event.id AS event_id' );
		$query->select( 'event.name AS event_name' );
		$query->select( 'event.date AS event_date' );
		$query->select( 'event.date_open AS ticket_open' );
		$query->select( 'event.date_close AS ticket_close' );
		$query->select( 'event.capacity AS event_capacity' );
		$query->select( 'event_ticket.quantity AS ticket_quantity' );
		$query->select('COUNT(ticket.id) AS tickets_sold');
		$query->select('GROUP_CONCAT( DISTINCT event_host.university_id ) AS host_university_ids');

		$query->from('#__swa_event_ticket AS event_ticket' );
		$query->innerJoin( '#__swa_event AS event ON event_ticket.event_id = event.id' );
		$query->leftJoin( '#__swa_event_host AS event_host ON event_host.event_id = event.id' );
		$query->leftJoin('#__swa_ticket AS ticket ON ticket.event_ticket_id = event_ticket.id');

		$query->where('event.date > NOW()');
		$query->group('id');

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );

		$tickets = parent::getItems();

		$member = $this->getMember();

		$allowedTickets = array();
		$totalTicketsSold = 0;

		// count total number of tickets sold
		foreach ($tickets as $ticket) {
			$totalTicketsSold += $ticket->tickets_sold;
		}

		foreach ($tickets as $ticket) {
			// get whether the ticket should displayed and the reason it can't be bought if there is one
			list($displayTicket, $ticket->reason) = $this->memberAllowedToViewBuyTicket( $member, $ticket );

			// if the event capacity is full display SOLD OUT message
			if ($totalTicketsSold >= $ticket->event_capacity) {
				$ticket->reason = 'Currently SOLD OUT!';
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
	 * Note: This could easily be tested at come point...
	 *
	 * @param object $member
	 * @param object $ticket
	 *
	 * @return array(bool, string) array($display, $reason)
	 */
	private function memberAllowedToViewBuyTicket( $member, $ticket ) {
		$display = true;
		$reason = '';

		$isRegisteredForEvent = ( in_array( $ticket->event_id, explode( ',', $member->registered_event_ids ) ) );
		$dateNow = time();

		// check if member has already bought a ticket to that event
		if ( in_array($ticket->event_id, explode( ',', $member->ticketed_event_ids )) ) {
			$reason = 'You have already bought a ticket to this event';
		} elseif ( $dateNow < strtotime($ticket->ticket_open) ) {
			$reason = 'Tickets sales haven\'t opened yet';
		} elseif ( $dateNow > strtotime($ticket->ticket_close) + 24*60*60 ) {
			// ticket sales close at midnight of the chosen day (hence the +24*60*60)
			$reason = 'SALES CLOSED!';
		} elseif ( $ticket->ticket_quantity <= $ticket->tickets_sold ) {
			$reason = 'Currently SOLD OUT!';
		}
		elseif( !$ticket->need_xswa && !$ticket->need_swa && !$isRegisteredForEvent ) {
			// Allow XSWA and SWA to buy tickets when not registered for the event
			$reason = 'You have not been registered for this event';
		} elseif( $ticket->need_swa && !$member->swa_committee ) {
			$reason = 'You have to be SWA committee to buy this ticket';
			$display = false;
		} elseif( $ticket->need_xswa && !$member->graduated ) {
			$reason = 'You need to be graduated to buy this ticket';
		} elseif( !empty( $ticket->need_level ) && $member->level != $ticket->need_level ) {
			$reason = "You need to be level '{$ticket->need_level}' to buy this ticket";
			$display = in_array( strtolower($ticket->need_level), array('beginner', 'intermediate', 'advanced') );
		} elseif( $ticket->need_qualification && !$member->qualification ) {
			$reason = 'You need to have an approved qualification to buy this ticket';
		} elseif( $ticket->need_host && !in_array( $member->university_id, explode( ',', $ticket->host_university_ids ) ) ) {
			$reason = 'You need to be at the university hosting the event to buy this ticket';
			$display = false;
		}

		return array($display, $reason);
	}

}
