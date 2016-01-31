<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelMemberTickets extends SwaModelList {

	public function getTable( $type = 'Ticket', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	public function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery( true );

		$query->select( 'a.id as id' );
		$query->from( $db->quoteName( '#__swa_ticket' ) . ' AS a' );
		$query->where( 'a.member_id = ' . $this->getMember()->id );
		$query->join( 'LEFT', '#__swa_event_ticket AS b ON a.event_ticket_id = b.id' );
		$query->select( 'b.name as ticket_name' );
		$query->select( 'c.name as event' );
		$query->select( 'c.date as date' );
		$query->join( 'LEFT', '#__swa_event AS c ON b.event_id = c.id' );
		$query->order( 'c.date ASC' );

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );

		$items = parent::getItems();

		return $items;
	}

}