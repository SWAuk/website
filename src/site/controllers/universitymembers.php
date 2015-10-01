<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerUniversityMembers extends SwaController {

	public function approve() {
		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data = $input->getArray();

		$currentMember = $this->getCurrentMember();
		if( !$currentMember->club_committee ) {
			die( 'Current member is not club committee' );
		}

		$targetMember = $this->getMember( $data['member_id'] );
		if( $currentMember->university_id != $targetMember->university_id ) {
			die( 'Current and target member are from different universities' );
		}

		// Approve the member for the university
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$columns = array( 'member_id', 'university_id');
		$values = array( $data['member_id'], $targetMember->university_id );

		$query
			->insert($db->quoteName('#__swa_university_member'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);
		if( !$db->execute() ) {
			JLog::add( 'SwaControllerUniversityMembers failed to approve: Member:' . $data['member_id'], JLog::INFO, 'com_swa' );
		}
		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers&layout=pending', false));
	}

	public function unapprove() {
		//TODO unapprove functionality
		die('Not yet implemented');
	}

	public function graduate() {
		//TODO graduate functionality
		die('Not yet implemented');
	}

	public function ungraduate() {
		//TODO ungraduate functionality
		die('Not yet implemented');
	}

	public function register() {
		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data = $input->getArray();

		$currentMember = $this->getCurrentMember();
		if( $currentMember->club_committee != 1 ) {
			die( 'Current member is not club committee' );
		}

		$targetMember = $this->getMember( $data['member_id'] );
		if( $currentMember->university_id != $targetMember->university_id ) {
			die( 'Current and target member are from different universities' );
		}

		$targetEvents = $this->getEvents( $data['event_id'] );
		if( empty( $targetEvents ) ) {
			die( 'Event does not exist with given id' );
		}

		// Add a new registration row
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$columns = array( 'event_id', 'member_id', 'date' );
		$values = array( $data['event_id'], $data['member_id'], 'NOW()' );

		$query
			->insert($db->quoteName('#__swa_event_registration'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);
		if( !$db->execute() ) {
			JLog::add( 'SwaControllerUniversityMembers failed to register: Event:' . $data['event_id'] . ' Member:' . $data['member_id'], JLog::INFO, 'com_swa' );
		}
		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	public function unregister() {
		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data = $input->getArray();

		$currentMember = $this->getCurrentMember();
		if( $currentMember->club_committee != 1 ) {
			die( 'Current member is not club committee' );
		}

		$targetMember = $this->getMember( $data['member_id'] );
		if( $currentMember->university_id != $targetMember->university_id ) {
			die( 'Current and target member are from different universities' );
		}

		$targetEvents = $this->getEvents( $data['event_id'] );
		if( empty( $targetEvents ) ) {
			die( 'Event does not exist with given id' );
		}

		// Delete all matching registration rows
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$conditions = array(
			$db->quoteName('event_id') . ' = ' . $db->quote( $data['event_id'] ),
			$db->quoteName('member_id') . ' = ' . $db->quote( $data['member_id'] )
		);

		$query->delete($db->quoteName('#__swa_event_registration'));
		$query->where($conditions);

		$db->setQuery($query);
		if( !$db->execute() ) {
			JLog::add( 'SwaControllerUniversityMembers failed to unregister: Event:' . $data['event_id'] . ' Member:' . $data['member_id'], JLog::INFO, 'com_swa' );
		}
		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	/**
	 * @param int $eventId
	 * @return mixed
	 */
	public function getEvents( $eventId ) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName('#__swa_event') . ' AS a' );
		$query->where( 'a.id = ' . $eventId );

		// Load the result
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	/**
	 * @param int $memberId
	 * @return mixed
	 */
	public function getMember( $memberId ) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName('#__swa_member') . ' AS a' );
		$query->where( 'a.id = ' . $memberId );

		// Load the result
		$db->setQuery($query);
		return $db->loadObject();
	}

	/**
	 * @return mixed
	 */
	public function getCurrentMember() {
		// Create a new query object.
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName('#__swa_member') . ' AS a' );
		$query->where( 'a.user_id = ' . $user->id );

		//Join on university_member
		$query->leftJoin( $db->quoteName('#__swa_university_member') . ' AS university_member ON a.id = university_member.member_id' );
		$query->select( 'COALESCE( university_member.graduated, 0 ) as graduated' );
		$query->select( '!ISNULL( university_member.member_id ) as confirmed_university' );
		$query->select( 'university_member.committee as club_committee' );

		// Load the result
		$db->setQuery($query);
		return $db->loadObject();
	}

}