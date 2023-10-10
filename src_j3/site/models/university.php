<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelUniversity extends SwaModelItem
{

	public function getTable($type = 'University', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @return JTable
	 */
	public function getItem()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$user  = JFactory::getUser();

		// Select the required fields from the table.
		$query->select('a.university_id AS university_id');
		$query->from($db->quoteName('#__swa_member') . ' AS a');
		$query->where('a.user_id = ' . $user->id);

		// Join over the university
		$query->select('b.name AS university');
		$query->select('b.url AS url');
		$query->join('LEFT', '#__swa_university AS b ON a.university_id = b.id');

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

}
