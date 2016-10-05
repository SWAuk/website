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
		$query->select( 'a.id as id' );
		$query->select( 'a.name as ticket_name' );
		$query->select( 'a.price as price' );
		$query->select( 'a.notes as notes' );
		$query->select( 'a.need_level as need_level' );
		$query->select( 'a.need_xswa as need_xswa' );
		$query->select( 'a.need_swa as need_swa' );
		$query->select( 'a.need_host as need_host' );
		$query->select( 'a.need_qualification as need_qualification' );
		$query->from( $db->quoteName( '#__swa_event_ticket' ) . ' AS a' );

		// Select details of the event
		$query->innerJoin( '#__swa_event as event ON a.event_id=event.id' );
		$query->select( 'event.name as event' );
		$query->select( 'event.id as event_id' );
		$query->select( 'event.date as event_date' );
		$query->select( 'event.date_close as event_close' );
		$query->select( 'event.capacity as capacity' );

		// Where we still have capacity left in the event
		$subQuerySold = $db->getQuery( true );
		$subQuerySold->select( 'COUNT( ticket.id )' );
		$subQuerySold->from( '#__swa_ticket as ticket' );
		$subQuerySold->rightJoin( '#__swa_event_ticket AS event_ticket ON ticket.event_ticket_id = event_ticket.id' );
		$subQuerySold->where( 'event_ticket.event_id=event.id' );
		$query->select( '( ' . $subQuerySold->__toString() . ' ) as sold' );
		$query->select( '( event.capacity - ( ' . $subQuerySold->__toString() . ' ) ) as capacity_remaining' );

		// Select details of the event hosts
		$query->join(
			'LEFT',
			'#__swa_event_host AS event_host ON event_host.event_id = a.event_id'
		);
		$query->select( 'GROUP_CONCAT( event_host.university_id ) as host_university_ids' );
		$query->group( 'a.id' );

		// Select event closed & open indicators
		$query->select( '( event.date_close < NOW() ) as event_has_closed' );
		$query->select( '( event.date_open < NOW() ) as event_has_opened' );
		// Where the event is in the future!
		$query->where( 'event.date > NOW()' );

		// Where we still have tickets remaining
		$subQuery = $db->getQuery( true );
		$subQuery->select( 'COUNT( ticket.id )' );
		$subQuery->from( '#__swa_ticket as ticket' );
		$subQuery->where( 'ticket.event_ticket_id=a.id' );
		$query->select( '( a.quantity - ( ' . $subQuery->__toString() . ' ) ) as quantity_remaining' );

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );

		$tickets = parent::getItems();
		$member = $this->getMember();
		$allowedTickets = array();

		foreach ( $tickets as $ticket ) {
			// Ignore tickets for events that we have already bought
			if ( in_array(
				$ticket->event_id,
				explode( ',', $this->getMember()->ticketed_event_ids )
			) ) {
				continue;
			}
			// Only allow tickets the member is allowed to buy
			$isAllowedToBuy = $this->memberAllowedToBuyTicket( $member, $ticket );
			if ( $isAllowedToBuy ) {
				$allowedTickets[] = $ticket;
			}
		}

		return $allowedTickets;
	}

	/**
	 * Should the given user be allowed to purchase the given ticket?
	 *
	 * Note: This could easily be tested at come point...
	 *
	 * @param object $member
	 * @param object $ticket
	 *
	 * @return bool
	 */
	private function memberAllowedToBuyTicket( $member, $ticket ) {
		$isRegisteredForEvent = ( in_array( $ticket->event_id, explode( ',', $member->registered_event_ids ) ) );

		if( $ticket->need_swa && !$member->swa_committee ) {
			return false;
		}
		if( $ticket->need_xswa && !$member->graduated ) {
			return false;
		}
		if( !empty( $ticket->need_level ) && $member->level != $ticket->need_level ) {
			return false;
		}
		if( $ticket->need_qualification && !$member->qualification ) {
			return false;
		}
		if( $ticket->need_host && !in_array( $member->university_id, explode( ',', $ticket->host_university_ids ) ) ) {
			return false;
		}

		//Allow following ticket types to be bought when not registered for the event
		if( !$ticket->need_xswa && !$ticket->need_swa && !$isRegisteredForEvent ) {
			return false;
		}

		return true;
	}

}
