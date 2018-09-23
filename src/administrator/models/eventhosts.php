<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelEventhosts extends JModelList
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
				'a.id',
				'event_id',
				'a.event_id',
				'university_id',
				'a.university_id',
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
		parent::populateState('a.id', 'desc');
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
		$query->from('`#__swa_event_host` AS a');

		// Join over for event
		$query->select('event.name AS event');
		$query->join('LEFT', '#__swa_event AS event ON event.id = a.event_id');
		// Join over for university
		$query->select('university.name AS university');
		$query->join(
			'LEFT',
			'#__swa_university AS university ON university.id = a.university_id'
		);

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
