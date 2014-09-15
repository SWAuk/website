<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelUniversityMembers extends JModelList {

	protected $member;

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable
	 */
	public function getTable( $type = 'Member', $prefix = 'SwaTable', $config = array() ) {
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

		$query->select( 'member.*' );
		$query->from( $db->quoteName('#__swa_member') . ' AS member' );
		$query->where( 'member.university_id = ' . $this->getMember()->university_id );

		// Join onto joomla user table
		$query->select( 'user.name AS name' );
		$query->join( 'LEFT', '#__users AS user ON member.user_id = user.id' );

		return $query;
	}

	/**
	 * Gets a list of event items that have not yet closed
	 */
	public function getAvailableEvents() {
		//TODO actually get a list of available event items
		return array();
	}

}