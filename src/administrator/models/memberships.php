<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelMemberships extends JModelList
{
	/**
	 * SwaModelMemberships constructor.
	 *
	 * @param array $config An optional associative array of configuration settings.
	 *
	 * @see   JModelList
	 *
	 * @since 0.2
	 */
	public function __construct(array $config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'season',
				'member.id',
				'member_name',
				'paid',
				'level',
				'university',
				'approved',
				'committee',
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$app    = JFactory::getApplication('administrator');
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		$this->setState('params', JComponentHelper::getParams('com_swa'));
		parent::populateState('season desc, member.id', 'desc');
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
		$query->select($this->getState('list.select', 'DISTINCT membership.*'));
		$query->select('user.name AS member_name');
		$query->select('season.year AS season');
		$query->select('uni.name AS university');

		$query->from('#__swa_membership AS membership');
		$query->leftJoin('#__swa_member AS member ON member.id = membership.member_id');
		$query->leftJoin('#__users AS user ON user.id = member.user_id');
		$query->leftJoin('#__swa_season AS season ON season.id = membership.season_id');
		$query->leftJoin('#__swa_university AS uni ON uni.id = membership.uni_id');

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where(
					'( member_id = ' . (int) substr($search, 3) .
					' OR membership.id = ' . (int) substr($search, 3) . ' )'
				);
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where(
					'( user.name LIKE ' . $search .
					' OR user.username LIKE ' . $search . ' )'
				);
			}
		}

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
		$items = parent::getItems();

		return $items;
	}

}
