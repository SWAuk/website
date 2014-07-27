<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * Swa helper.
 */
class SwaHelperTableGetter {

	public static function getUniversities() {
		$db = JFactory::getDBO();
		$query = $db->getQuery( true );
		$query->select( 'id,name' );
		$query->from( '#__swa_university' );
		$db->setQuery( (string)$query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getSeasons() {
		$db = JFactory::getDBO();
		$query = $db->getQuery( true );
		$query->select( 'id,year' );
		$query->from( '#__swa_season' );
		$db->setQuery( (string)$query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getEvents() {
		$db = JFactory::getDBO();
		$query = $db->getQuery( true );
		$query->select( 'id,name' );
		$query->from( '#__swa_event' );
		$db->setQuery( (string)$query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getTicketTypes() {
		$db = JFactory::getDBO();
		$query = $db->getQuery( true );
		$query->select( 'id,name' );
		$query->from( '#__swa_ticket_type' );
		$db->setQuery( (string)$query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getRaceTypes() {
		$db = JFactory::getDBO();
		$query = $db->getQuery( true );
		$query->select( 'id,name' );
		$query->from( '#__swa_race_type' );
		$db->setQuery( (string)$query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getMembers() {
		$db = JFactory::getDBO();
		$query = "SELECT member.id, users.name as name FROM #__swa_member AS member
		INNER JOIN #__users AS users ON member.user_id=users.id";
		$db->setQuery( $query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getRaces() {
		$db = JFactory::getDBO();
		$query = "SELECT race.id, CONCAT( event.name, ' - ' , race_type.name ) as event_race_name FROM #__swa_race AS race
		INNER JOIN #__swa_event AS event ON race.event_id=event.id
		INNER JOIN #__swa_race_type AS race_type ON race.race_type_id=race_type.id";
		$db->setQuery( $query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

	public static function getEventTickets() {
		$db = JFactory::getDBO();
		$query = "SELECT event_ticket.id, CONCAT( event.name, ' - ' , ticket_type.name ) as event_ticket_name FROM #__swa_event_ticket AS event_ticket
		INNER JOIN #__swa_event AS event ON event_ticket.event_id=event.id
		INNER JOIN #__swa_ticket_type AS ticket_type ON event_ticket.ticket_type_id=ticket_type.id";
		$db->setQuery( $query );
		$list = $db->loadObjectList( 'id' );
		return $list;
	}

}