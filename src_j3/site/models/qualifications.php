<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelQualifications extends SwaModelList
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

		$member = $this->getMember();

		// Select the required fields from the table.
		$query->select(
			array(
				'a.id as id',
				'users.name as member',
				'a.type as type',
				'a.expiry_date as expiry',
				'a.approved as approved',
			)
		);
		$query->from('`#__swa_qualification` AS a');
		$query->where('a.member_id = ' . $member->id);

		// Join over the user field 'user_id'
		$query->join('LEFT', '#__swa_member AS member ON member.id = a.member_id');
		$query->join('LEFT', '#__users AS users ON users.id = member.user_id');
		$query->join(
			'LEFT',
			'#__swa_university AS university ON university.id = member.university_id'
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
		// NEVER limit this list
		$this->setState('list.limit', '0');

		$items = parent::getItems();

		return $items;
	}

	public function getForm()
	{
		$form =
			$this->loadForm(
				'com_swa.qualification',
				'qualification',
				array('control' => 'jform')
			);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

}
