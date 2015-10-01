<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelUniversityMembers extends SwaModelList {

	protected $items;

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable
	 */
	public function getTable( $type = 'Member', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	public function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select( 'member.*' );
		$query->from( $db->quoteName('#__swa_member') . ' AS member' );
		$query->where( 'member.university_id = ' . $this->getMember()->university_id );

		// Join onto joomla user table
		$query->select( 'user.name AS name' );
		$query->join( 'LEFT', '#__users AS user ON member.user_id = user.id' );

		// Join onto the university_member table
		$query->leftJoin( $db->quoteName('#__swa_university_member') . ' AS university_member ON member.id = university_member.member_id' );
		$query->select( 'COALESCE( university_member.graduated, 0 ) as graduated' );
		$query->select( '!ISNULL( university_member.member_id ) as confirmed_university' );
		$query->select( 'university_member.committee as club_committee' );

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );
		if( !isset( $this->items ) ) {
			$this->items = parent::getItems();
		}
		return $this->items;
	}

	/**
	 * Gets a list of event items that have not yet closed
	 * @return array
	 */
	public function getAvailableEvents() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select( 'event.*' );
		$query->from( $db->quoteName('#__swa_event') . ' AS event' );
		$query->where( 'event.date_close >= CURDATE()' );

		$db->setQuery( $query );
		$result = $db->execute();

		if( !$result ) {
			JLog::add( 'SwaModelUniversityMembers::getAvailableEvents failed to do db query', JLog::ERROR, 'com_swa' );
			return array();
		}

		return $db->loadObjectList();
	}

	/**
	 * Gets a list of event registrations for the members listed
	 * @return array
	 */
	public function getEventRegistrations() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->from( $db->quoteName('#__swa_event_registration') . ' AS event_registration' );
		$query->select( 'event_registration.*' );
		foreach( $this->getItems() as $member ) {
			$query->where( 'event_registration.member_id = ' . $member->id, 'OR' );
		}

		$db->setQuery( $query );
		$result = $db->execute();

		if( !$result ) {
			JLog::add( 'SwaModelUniversityMembers::getEventRegistrations failed to do db query', JLog::ERROR, 'com_swa' );
			return array();
		}

		return $db->loadObjectList( 'id' );
	}

}