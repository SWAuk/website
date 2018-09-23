<?php

class SwaFactory
{

	public static function getUserFromMemberId($id)
	{
		// Create a new query object.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('a.*');
		$query->from($db->quoteName('#__swa_member') . ' AS a');
		$query->where('a.id = ' . $id);

		// Load the result
		$db->setQuery($query);
		$member = $db->loadObject();

		if (!$member->user_id)
		{
			throw new RuntimeException;
		}

		return JFactory::getUser($member->user_id);
	}

}
