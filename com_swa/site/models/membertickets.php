<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelMemberTickets extends JModelList {

	protected $member;

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable
	 */
	public function getTable( $type = 'Ticket', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

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

		$query->select( 'a.id as id' );
		$query->from( $db->quoteName('#__swa_ticket') . ' AS a' );
		$query->where( 'a.member_id = ' . $this->getMember()->id );
		$query->join( 'LEFT', '#__swa_event_ticket AS b ON a.event_ticket_id = b.id' );
		$query->select( 'c.name as event' );
		$query->select( 'c.date as date' );
		$query->join( 'LEFT', '#__swa_event AS c ON b.event_id = c.id' );
		$query->select( 'd.name as ticket_type' );
		$query->join( 'LEFT', '#__swa_ticket_type AS d ON b.ticket_type_id = d.id' );
		$query->order( 'c.date ASC' );

		return $query;
	}

}