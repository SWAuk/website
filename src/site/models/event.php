<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelEvent extends SwaModelItem {

	public function getTable( $type = 'Event', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * @return int
	 * @throws Exception
	 */
	private function getEventId() {
		$app = JFactory::getApplication();
		$eventId = $app->input->getInt( 'event' );
		if( !is_int( $eventId ) ) {
			throw new InvalidArgumentException( "No event ID given" );
		}
		return $eventId;
	}

	/**
	 * @return JTable
	 */
	public function getItem() {
		$eventId = $this->getEventId();

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

	public function getTeamResults() {
		$eventId = $this->getEventId();

		$db = $this->getDbo();
		$query = $db->getQuery( true );

		$query->select(
			array(
				'university.name',
				'team_result.*',
			)
		);
		$query->from( '`#__swa_competition` AS comp' );
		$query->where( 'comp.event_id = ' . $db->quote( $eventId ) );
		$query->join( 'LEFT', '#__swa_competition_type AS comp_type ON comp_type.id = comp.competition_type_id' );
		$query->join( 'LEFT', '#__swa_team_result AS team_result ON comp.id = team_result.competition_id' );
		$query->join( 'LEFT', '#__swa_university AS university ON university.id = team_result.university_id' );
		$query->order( 'team_result.result' );
		$query->where( 'team_result.result IS NOT NULL' );

		$db->setQuery( $query );

		return $db->loadAssocList();
	}

	public function getIndiResults() {
		$eventId = $this->getEventId();

		$db = $this->getDbo();
		$query = $db->getQuery( true );

		$query->select(
			array(
				'user.name',
				'university.name as university',
				'indi_result.*',
				'comp_type.name as comp_name',
			)
		);
		$query->from( '`#__swa_competition` AS comp' );
		$query->where( 'comp.event_id = ' . $db->quote( $eventId ) );
		$query->join( 'LEFT', '#__swa_competition_type AS comp_type ON comp_type.id = comp.competition_type_id' );
		$query->join( 'LEFT', '#__swa_indi_result AS indi_result ON comp.id = indi_result.competition_id' );
		$query->join( 'LEFT', '#__swa_member AS member ON member.id = indi_result.member_id' );
		$query->join( 'LEFT', '#__swa_university AS university ON member.university_id = university.id' );
		$query->join( 'LEFT', '#__users AS user ON user.id = member.user_id' );
		$query->order( 'indi_result.result' );
		$query->where( 'indi_result.result IS NOT NULL' );

		$db->setQuery( $query );

		$result = $db->loadAssocList();

		$items = array();
		foreach( $result as $row ) {
			$items[$row['comp_name']][] = $row;
		}

		return $items;
	}

	public function getTicketSales() {
		$eventId = $this->getEventId();

		$db = $this->getDbo();
		$query = $db->getQuery( true );

		$query->select(
			array(
				'event_ticket.name',
				'round(event_ticket.price,0) as price',
				'concat(round((count(ticket.id)/event_ticket.quantity*100),0),\'%\') as percentage_sold',
				'count(ticket.id) as sold',
				'event_ticket.quantity',
				'(event_ticket.quantity-count(ticket.id)) as remaining',
			)
		);
		$query->from( '`#__swa_ticket` AS ticket' );
		$query->rightJoin( '`#__swa_event_ticket` AS event_ticket ON ticket.event_ticket_id = event_ticket.id' );
		$query->join( 'INNER', '`#__swa_event` as event ON event_ticket.event_id = event.id' );
		$query->where( 'event_ticket.event_id = ' . $db->quote( $eventId ) );
		$query->group( 'event_ticket_id' );

		$db->setQuery( $query );

		return $db->loadAssocList();
	}

}
