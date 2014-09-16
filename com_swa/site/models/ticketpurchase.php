<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelTicketPurchase extends JModelList {

	protected $member;

	/**
	 * @return JTable|mixed
	 */
	public function getMember() {
		if( !isset( $this->member ) ) {
			// Create a new query object.
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();

			// Select the required fields from the table.
			$query->select( 'a.*' );
			$query->from( $db->quoteName('#__swa_member') . ' AS a' );
			$query->where( 'a.user_id = ' . $user->id );

			// Join onto the university_member table
			$query->leftJoin( $db->quoteName('#__swa_university_member') . ' AS b ON a.id = b.member_id' );
			$query->select( 'b.graduated as graduated' );
			$query->select( 'count( b.id ) as confirmed_university' );

			// Get instructor info
			$subQuery = $db->getQuery(true);
			$subQuery->select( 'COUNT(*)' );
			$subQuery->from( $db->quoteName('#__swa_instructor') . ' AS instructor' );
			$subQuery->where( 'instructor.expiry_date > NOW()' );
			$query->select( '(' . $subQuery->__toString() . ') as instructor' );

			// Get event ids registered for!
			$query->join( 'LEFT', '#__swa_event_registration AS event_registration ON event_registration.member_id = a.id' );
			$query->select( 'GROUP_CONCAT( CASE WHEN event_registration.date > NOW() - INTERVAL 3 DAY THEN event_registration.event_id END ) as registered_event_ids' );
			$query->group( 'a.id' );

			// Load the result
			$db->setQuery($query);
			$this->member = $db->loadObject();
		}
		return $this->member;
	}

	public function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select all event tickets
		$query->select( 'a.id as id' );
		$query->select( 'a.name as ticket_name' );
		$query->select( 'a.need_xswa as need_xswa' );
		$query->select( 'a.need_swa as need_swa' );
		$query->select( 'a.need_host as need_host' );
		$query->select( 'a.need_instructor as need_instructor' );
		$query->from( $db->quoteName('#__swa_event_ticket') . ' AS a' );

		// Select details of the event
		$query->innerJoin( '#__swa_event as event ON a.event_id=event.id' );
		$query->select( 'event.name as event' );
		$query->select( 'event.id as event_id' );
		$query->select( 'event.date as event_date' );
		$query->select( 'event.date_close as event_close' );

		// Select details of the event hosts
		$query->join( 'LEFT', '#__swa_event_host AS event_host ON event_host.event_id = a.event_id' );
		$query->select( 'GROUP_CONCAT( event_host.university_id ) as host_university_ids' );
		$query->group( 'a.id' );

		// Where the event has not already closed
		$query->where( 'event.date_close > NOW()' );
		// Where the event has opened!
		$query->where( 'event.date_open < NOW()' );

		// Where we still have tickets remaining
		$subQuery = $db->getQuery(true);
		$subQuery->select( 'COUNT( ticket.id )' );
		$subQuery->from( '#__swa_ticket as ticket' );
		$subQuery->where( 'ticket.event_ticket_id=a.id' );
		$query->where( '( a.quantity - ( ' . $subQuery->__toString() . ' ) ) > 0' );

		return $query;
	}

	public function getItems() {
		$tickets = parent::getItems();
		$member = $this->getMember();
		$allowedTickets = array();

		foreach( $tickets as $ticket ) {
			if(
				( $ticket->need_xswa && $member->graduated ) ||
				( $ticket->need_swa && $member->swa_committee ) ||
				( $ticket->need_instructor && $member->instructor ) ||
				( $ticket->need_host && in_array( $member->university_id, explode( ',', $ticket->host_university_ids ) ) ) ||
				( in_array( $ticket->event_id, explode( ',', $member->registered_event_ids ) ) )
			) {
				$allowedTickets[] = $ticket;
			}
		}

		return $allowedTickets;
	}

}