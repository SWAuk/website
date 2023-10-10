<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelMembers extends SwaModelList
{

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Load the filter state.
		$search =
			$app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_swa');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string $id A prefix for the store id.
	 *
	 * @return    string        A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return    JDatabaseQuery
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'DISTINCT a.*'
			)
		);
		$query->from($db->qn('#__swa_member', 'a'));

		// Join over the user field 'user_id'
		$query->select($db->qn('user_id.name', 'user'));
		$query->leftJoin('#__users AS user_id ON user_id.id = a.user_id');

		// Join over the user field 'university_id'
		$query->select('university_id.name AS university');
		$query->leftJoin('#__swa_university AS university_id ON university_id.id = a.university_id');

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		// Join on membership table
		$query->leftJoin('#__swa_membership AS membership ON membership.member_id = a.id');
		$query->select('membership.season_id');
		$query->leftJoin('#__swa_season AS season ON membership.season_id = season.id');
		$query->where('(season.year LIKE "' . (int) $date . '%" OR membership.season_id IS NULL)');

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	public function getItems()
	{
		// NEVER limit this list
		$this->setState('list.limit', '0');

		$items = parent::getItems();

		return $items;
	}

}
