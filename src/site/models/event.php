<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelEvent extends SwaModelItem
{

	public function getTable($type = 'Event', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @return integer
	 * @throws Exception
	 */
	private function getEventId()
	{
		$app     = JFactory::getApplication();
		$eventId = $app->input->getInt('event');

		if (!is_int($eventId))
		{
			throw new InvalidArgumentException("No event ID given");
		}

		return $eventId;
	}

	/**
	 * @return JTable
	 */
	public function getItem()
	{
		/** SQL Query used below. Not all of this query is currently used
		 * left here to demonstrate how to list the uni_ids and the uni_names
		 *
		 * SELECT
		 * event.id AS event_id,
		 * event.name AS event_name,
		 * event.date AS event_date,
		 * event.date_close AS event_date_close,
		 * season.year AS season,
		 * GROUP_CONCAT(event_host.university_id) AS host_ids,
		 * GROUP_CONCAT(uni.name) AS host_names
		 *
		 * FROM swan_swa_event AS event
		 * JOIN swan_swa_season AS season ON season.id = event.season_id
		 * LEFT JOIN swan_swa_event_host AS event_host ON event.id = event_host.event_id
		 * JOIN swan_swa_university AS uni ON event_host.university_id = uni.id
		 *
		 * WHERE event.id = 122
		 */

		$eventId = $this->getEventId();

		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(array(
				'event.id AS event_id',
				'event.name AS event_name',
				'event.date AS event_date',
				'event.date_close AS event_date_close',
				'season.year AS season',
				'GROUP_CONCAT(event_host.university_id) AS hosts'
			)
		);

		$query->from('#__swa_event AS event');
		$query->innerJoin('#__swa_season AS season ON season.id = event.season_id');
		$query->leftJoin('#__swa_event_host AS event_host ON event.id = event_host.event_id');

		$query->where('event.id = ' . $db->quote($eventId));

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

	public function getTeamResults()
	{
		$eventId = $this->getEventId();

		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(
			array(
				'university.name',
				'team_result.*',
			)
		);
		$query->from('`#__swa_competition` AS comp');
		$query->where('comp.event_id = ' . $db->quote($eventId));
		$query->join('LEFT', '#__swa_competition_type AS comp_type ON comp_type.id = comp.competition_type_id');
		$query->join('LEFT', '#__swa_team_result AS team_result ON comp.id = team_result.competition_id');
		$query->join('LEFT', '#__swa_university AS university ON university.id = team_result.university_id');
		$query->order('team_result.result');
		$query->where('team_result.result IS NOT NULL');

		$db->setQuery($query);

		return $db->loadAssocList();
	}

	public function getIndiResults()
	{
		$eventId = $this->getEventId();

		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(
			array(
				'user.name',
				'university.name as university',
				'indi_result.*',
				'comp_type.name as comp_name',
			)
		);
		$query->from('`#__swa_competition` AS comp');
		$query->where('comp.event_id = ' . $db->quote($eventId));
		$query->join('LEFT', '#__swa_competition_type AS comp_type ON comp_type.id = comp.competition_type_id');
		$query->join('LEFT', '#__swa_indi_result AS indi_result ON comp.id = indi_result.competition_id');
		$query->join('LEFT', '#__swa_member AS member ON member.id = indi_result.member_id');
		$query->join('LEFT', '#__swa_university AS university ON member.university_id = university.id');
		$query->join('LEFT', '#__users AS user ON user.id = member.user_id');
		$query->order('indi_result.result');
		$query->where('indi_result.result IS NOT NULL');

		$db->setQuery($query);

		$result = $db->loadAssocList();

		$items = array();

		foreach ($result as $row)
		{
			$items[$row['comp_name']][] = $row;
		}

		return $items;
	}

	public function getTicketSales()
	{
		$eventId = $this->getEventId();

		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(
			array(
				'event_ticket.name',
				'round(event_ticket.price,2) as price',
				'concat(round((count(ticket.id)/event_ticket.quantity*100),0),\'%\') as percentage_sold',
				'count(ticket.id) as sold',
				'event_ticket.quantity',
				'(event_ticket.quantity-count(ticket.id)) as remaining',
			)
		);

		$query->from('#__swa_event_ticket AS event_ticket ');
		$query->leftJoin('#__swa_ticket AS ticket ON ticket.event_ticket_id = event_ticket.id');
		$query->where('event_ticket.event_id = ' . $db->quote($eventId));
		$query->group('event_ticket.id');

		$db->setQuery($query);

		return $db->loadAssocList();
	}

	public function getEventAttendees()
	{
		$eventId = $this->getEventId();

		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$cols = array('Name', 'Uni', 'Ticket', 'Level', 'Gender', 'RacingCategory', 'Dietary', 'EmergencyContact', 'EmergencyNumber', 'Details');

		$query->select(
			$query->qn(
				array('user.name', 'uni.name', 'event_ticket.name', 'member.level', 'member.gender', 'member.race',
				'member.dietary', 'member.econtact', 'member.enumber', 'ticket.details'),
				$cols
			)
		);
		$query->from('#__users AS user');
		$query->leftJoin('#__swa_member AS member ON user.id = member.user_id');
		$query->leftJoin('#__swa_university AS uni ON member.university_id = uni.id');
		$query->leftJoin('#__swa_ticket AS ticket ON member.id = ticket.member_id');
		$query->leftJoin('#__swa_event_ticket AS event_ticket ON ticket.event_ticket_id = event_ticket.id');
		$query->where('event_ticket.event_id = ' . (int) $eventId);
		$query->order('uni.name, user.name');

		$db->setQuery($query);

		return $db->loadAssocList();
	}
}
