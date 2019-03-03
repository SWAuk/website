<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelUniversityMembers extends SwaModelList
{
	protected $items;

	public function getTable($type = 'Member', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getListQuery()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('member.id');
		$query->select('user.name');
		$query->select('membership.approved');
		$query->select('membership.level');
		$query->select('membership.committee AS club_committee');
		$query->select('membership.season_id');
		$query->select('uni.name AS university');

		$query->from('#__swa_member AS member');
		$query->leftJoin( '#__users AS user ON user.id = member.user_id');
		$query->leftJoin('#__swa_membership AS membership ON membership.member_id = member.id');
		$query->leftJoin('#__swa_season AS season ON season.id = membership.season_id');
		$query->leftJoin('#__swa_university AS uni ON uni.id = membership.uni_id');

		$query->where('membership.uni_id = ' . (int) $this->getMember()->uni_id);

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$query->where('(season.year LIKE "' . (int) $date . '%" OR membership.season_id IS NULL)');

		$query->order('user.name');

		return $query;
	}

	public function getItems()
	{
		// NEVER limit this list
		$this->setState('list.limit', '0');

		if (!isset($this->items))
		{
			$this->items = parent::getItems();
		}

		return $this->items;
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('name', 'desc');
	}

	/**
	 * Gets a list of event items that have not yet closed
	 * @return array
	 */
	public function getAvailableEvents()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('event.*');
		$query->from($db->quoteName('#__swa_event', 'event'));
		$query->where('event.date_close >= CURDATE()');

		$db->setQuery($query);
		$result = $db->execute();

		if (!$result)
		{
			JLog::add(
				'SwaModelUniversityMembers::getAvailableEvents failed to do db query',
				JLog::ERROR,
				'com_swa'
			);

			return array();
		}

		return $db->loadObjectList();
	}

	/**
	 * Gets a list of event registrations for the members listed
	 * @return array
	 */
	public function getEventRegistrations()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('event_registration.*');
		$query->from($db->quoteName('#__swa_event_registration', 'event_registration'));

		foreach ($this->getItems() as $member)
		{
			$query->where('event_registration.member_id = ' . $member->id, 'OR');
		}

		$db->setQuery($query);
		$result = $db->execute();

		if (!$result)
		{
			JLog::add(
				'SwaModelUniversityMembers::getEventRegistrations failed to do db query',
				JLog::ERROR,
				'com_swa'
			);

			return array();
		}

		return $db->loadObjectList('id');
	}

}
