<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelUniversityEventAttendees extends SwaModelList
{
	protected $items;

	public function getTable($type = 'Event', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getItems()
	{
		// NEVER limit this list
		$this->setState('list.limit', '0');
		$this->items = parent::getItems();

		return $this->items;
	}

	public function getListQuery()
	{
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$member = $this->getMember();

		$query->select('ticket.id AS ticket_id');
		$query->select('event.id AS event_id');
		$query->select('member.id AS member_id');
		$query->select('user.name AS member_name');
		$query->select('event_ticket.name AS ticket_name');
		$query->select('event.name AS event_name');
		$query->select('event.date_open AS event_date_open');
		$query->select('event.date_close AS event_date_close');
		$query->select('event.date AS event_date');

		$query->from('#__swa_ticket AS ticket');
		$query->innerJoin('#__swa_event_ticket AS event_ticket ON event_ticket.id = ticket.event_ticket_id');
		$query->innerJoin('#__swa_event AS event ON event.id = event_ticket.event_id');
		$query->innerJoin('#__swa_membership AS membership ON membership.member_id = ticket.member_id ');
		$query->innerJoin('#__swa_member AS member ON member.id = ticket.member_id ');
		$query->innerJoin('#__users AS user ON user.id = member.user_id');

		// Where the event is in the future (or in the past few days)
		$query->where('event.date > NOW() - INTERVAL 3 DAY');
		// AND where the Uni IDs match
		$query->where("membership.uni_id = {$query->quote($member->uni_id)}");

		$query->order('event.date ASC, ticket.id DESC');

		return $query;
	}
}
