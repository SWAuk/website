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
		$query->from( $db->quoteName('#__swa_event_ticket') . ' AS a' );

		// Select details of the event
		$query->innerJoin( '#__swa_event as event ON a.event_id=event.id' );
		$query->select( 'event.name as event' );
		$query->select( 'event.date as event_date' );
		$query->select( 'event.date_close as event_close' );

		// Where the event has not already closed
		$query->where( 'event.date_close > NOW()' );

		// Where we still have tickets remaining
		$subQuery = $db->getQuery(true);
		$subQuery->select( 'COUNT( ticket.id )' );
		$subQuery->from( '#__swa_ticket as ticket' );
		$subQuery->where( 'ticket.event_ticket_id=a.id' );
		$query->where( '( a.quantity - ( ' . $subQuery->__toString() . ' ) ) > 0' );

		return $query;
	}

	public function getItems() {
		$items = parent::getItems();
		//TODO make sure member is currently registered to buy tickets
		//TODO make sure current member can buy said ticket
		return $items;
	}

}