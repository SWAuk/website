<?php
/**
 * This file contains /hacks/ :(
 */
$dispatcher = JEventDispatcher::getInstance();

/**
 * Remove menu items if the user should not have access to them.
 *
 * This requires the following event to be registered:
 * JEventDispatcher::getInstance()->trigger('onModMenuHelperGetList',array( &$items ));
 *
 * This event should be triggered just before the return of ModMenuHelper::GetList
 */
$dispatcher->register( 'onModMenuHelperGetList', function( &$items ) {

	//TODO XXX this is taken straight from SwaModelList::getMember. SHOULD REUSE
	// Create a new query object.
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$user = JFactory::getUser();
	// Select the required fields from the table.
	$query->select( 'a.*' );
	$query->from( $db->quoteName('#__swa_member') . ' AS a' );
	$query->where( 'a.user_id = ' . $user->id );
	// Join on committee table
	$query->leftJoin( '#__swa_committee as committee on committee.member_id = a.id' );
	$query->select( '!ISNULL(committee.id) as swa_committee' );
	// Join on committee table
	$query->leftJoin( '#__swa_university_member as uni_member on uni_member.member_id = a.id' );
	$query->select( 'IF( uni_member.committee = "None", NULL, 1 ) as club_committee' );
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
		return;
	}

	// Remove all items that the member is not allowed to see
	foreach( $items as $key => $item ) {
		if( !is_object( $member ) || ( $item->access == $aclClubCommittee && !$member->club_committee ) ) {
			unset( $items[$key] );
		}
		if( !is_object( $member ) || ( $item->access == $aclOrgCommittee && !$member->swa_committee ) ) {
			unset( $items[$key] );
		}
	}

} );