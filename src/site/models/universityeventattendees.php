<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelUniversityEventAttendees extends SwaModelList {

	protected $items;

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable
	 */
	public function getTable( $type = 'Event', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );
		$this->items = parent::getItems();
		return $this->items;
	}

	public function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Get the events
		$query->select( 'event.*' );
		$query->from( $db->quoteName('#__swa_event') . ' AS event' );
		// Where the event is in the future (or in the past few days)
		$query->where( 'event.date > NOW() - INTERVAL 3 DAY' );

		// Get all tickets for said events
		$query->innerJoin( $db->quoteName('#__swa_event_ticket') . ' AS event_ticket ON event.id=event_ticket.event_id' );
		$query->innerJoin( $db->quoteName('#__swa_ticket') . ' AS ticket ON event_ticket.id=ticket.event_ticket_id' );
		$query->select( 'event_ticket.name as ticket_name' );
		$query->select( 'ticket.member_id as member_id' );

		// Join on to the member and user table
		$query->leftJoin( $db->quoteName('#__swa_member') . ' AS member ON member.id = ticket.member_id' );
		$query->leftJoin( $db->quoteName('#__users') . ' AS user ON member.user_id = user.id' );
		$query->select( 'user.name as member_name' );

		return $query;
	}

}