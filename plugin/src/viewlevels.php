<?php
// no direct access
defined( '_JEXEC' ) or die;

class plgSwaViewLevels extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = false;

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	function onJAccessGetAuthorisedViewLevels( $userId, &$authorised )
	{
		//TODO check com_swa is loaded before we try to do this?

		//TODO XXX this is taken straight from SwaModelList::getMember. SHOULD REUSE
		// Create a new query object.
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser( $userId );
		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName('#__swa_member') . ' AS a' );
		$query->where( 'a.user_id = ' . $user->id );
		// Join on committee table
		$query->leftJoin( '#__swa_committee as committee on committee.member_id = a.id' );
		$query->select( '!ISNULL(committee.id) as swa_committee' );
		// Join on committee table
		$query->leftJoin( '#__swa_university_member as uni_member on uni_member.member_id = a.id' );
		$query->select( 'uni_member.committee as club_committee' );
		// Load the result
		$db->setQuery($query);
		$member = $db->loadObject();

		// Load the view levels for the component from the DB
		$viewLevelQuery = $db->getQuery(true)
			->select('id, title')
			->from($db->quoteName('#__viewlevels'));
		$db->setQuery($viewLevelQuery);
		foreach ($db->loadAssocList() as $level) {
			if( $level['title'] == 'Club Committee' ) {
				$aclClubCommittee = intval( $level['id'] );
			}
			if( $level['title'] == 'Org Committee' ) {
				$aclOrgCommittee = intval( $level['id'] );
			}
		}
		// If one of them was not found then return
		if( !isset( $aclClubCommittee ) || !isset( $aclOrgCommittee ) ) {
			//TODO log?
			return;
		}

		// club_committee is "0", when not in the committee, which will evaluate to false 
		// or, when they are in the committee, is a string that will evaluate to true
		if( is_object( $member ) && $member->club_committee ){
			$authorised[] = $aclClubCommittee;
		}
		if( is_object( $member ) && $member->swa_committee ){
			$authorised[] = $aclOrgCommittee;
		}
	}
}
