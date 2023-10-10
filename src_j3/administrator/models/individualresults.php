<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelIndividualresults extends JModelList
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
				'event_id.date',
				'competition_type',
				'result',
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
		parent::populateState('event_id.date DESC, competition_type, result', 'asc');
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
		$query->from('`#__swa_indi_result` AS a');

		// Join onto the member table
		$query->select('member_id.user_id as user_id');
		$query->join('LEFT', '#__swa_member as member_id ON a.member_id = member_id.id');
		// Join over the user field 'member_id'
		$query->select('user_id.name AS user');
		$query->join('LEFT', '#__users AS user_id ON user_id.id = member_id.user_id');
		// Join over 'competition_id'
		$query->join(
			'LEFT',
			'#__swa_competition AS competition_id ON competition_id.id = a.competition_id'
		);
		// Join over 'event_id'
		$query->select('event_id.name AS event');
		$query->join('LEFT', '#__swa_event AS event_id ON event_id.id = competition_id.event_id');
		// Join over 'competition_type_id'
		$query->select('competition_type_id.name AS competition_type');
		$query->join(
			'LEFT',
			'#__swa_competition_type AS competition_type_id ON competition_type_id.id = competition_id.competition_type_id'
		);

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
					' OR user_id.username LIKE ' . $search .
					' OR competition_type_id.name LIKE ' . $search .
					' OR event_id.name LIKE ' . $search . ' )'
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
