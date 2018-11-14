<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelMembers extends JModelList
{
	/**
	 * @param   array $config An optional associative array of configuration settings.
	 *
	 * @see        JController
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'user',
				'university',
				'lifetime_member'
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');
		$this->setState(
			'filter.search',
			$app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search')
		);
		$this->setState('params', JComponentHelper::getParams('com_swa'));
		parent::populateState('id', 'desc');
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
		$query->select($this->getState('list.select', 'DISTINCT a.*'));
		$query->from('#__swa_member AS a');

		// Join over the user field 'user_id'
		$query->select('user_id.name AS user');
		$query->select('user_id.email AS email');
		$query->leftJoin('#__users AS user_id ON user_id.id = a.user_id');
		$query->leftJoin('#__swa_membership AS membership ON membership.member_id = a.id');
		// Join over the user field 'university_id'
		$query->select('university_id.name AS university');
		$query->leftJoin('#__swa_university AS university_id ON university_id.id = membership.uni_id');

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where(
					'( user_id.name LIKE ' . $search .
					' OR  user_id.username LIKE ' . $search . ' )'
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
