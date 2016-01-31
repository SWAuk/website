<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelEvent extends SwaModelItem {

	public function getTable( $type = 'Event', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * @return JTable
	 */
	public function getItem() {
		$app = JFactory::getApplication();
		$eventId = $app->input->getInt( 'event' );
		if( !is_int( $eventId ) ) {
			return null;
		}

		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery( true );

		$event = new stdClass();
		$event->id = 1;

		$query->select( 'event.*' );
		$query->from( '`#__swa_event` AS event' );
		$query->where( 'event.id = ' . $db->quote( $eventId ) );

		// Join over for season_id
		$query->select( 'season.year as season' );
		$query->join( 'LEFT', '#__swa_season AS season ON season.id = event.season_id' );

		// Join for hosts
		$query->select( 'GROUP_CONCAT(university.name) AS hosts' );
		$query->join( 'LEFT', '#__swa_event_host AS event_host ON event.id = event_host.id' );
		$query->join(
			'LEFT',
			'#__swa_university AS university ON event_host.university_id = university.id'
		);

		// Load the result
		$db->setQuery( $query );

		return $db->loadObject();
	}

}