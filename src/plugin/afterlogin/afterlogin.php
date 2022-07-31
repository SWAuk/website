<?php

// No direct access
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

class PlgSwaAfterlogin extends JPlugin
{
	public function onUserAfterLogin($options)
	{

		$user = JFactory::getUser();
		$isroot = $user->authorise('core.admin');

		if ($isroot) {
			return;
		}
		// User data
		$user_id = $options['user']->id;

		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$agreement_check = $db->getQuery(true);
		$committee_check = $db->getQuery(true);

		/*
		We need to join this onto the university agreements page to see if there is a valid agreement
		There are two cases, if there is a current agrement, then we need to check the date and the signed value.
		Otherwise we need the member to create one.
		*/

		$agreement_check
			->select('agr.*')
			->from($db->quoteName('#__swa_member', 'smem'))
			->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
				. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
				' = ' . $db->quoteName('suni.university_id'))
			->join('INNER', $db->quoteName('#__university_agreements', 'agr') . " ON " .
				$db->quoteName('smem.university_id') . ' = ' . $db->quoteName('agr.university_id')
			)
			->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user_id));

		$db->setQuery($agreement_check);
		$results = $db->loadRow();
		JFactory::getApplication()->enqueueMessage(json_encode($results));

		// Check if valid agreement
		$valid = false;
		if ($results['override'] == 1) {
			$valid = true;
		}
elseif ($results['signed'] == 1 && $results['date'] != null) {
			if (strtotime($results['date']) < strtotime('-1 year')) {
				// If valid agreement
				$valid = true;
					}
		}

		$status = 'Valid agreement';

		if (!$valid) {
			$committee_check
				->select('count(*)')
				->from($db->quoteName('#__swa_member', 'smem'))
				->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
					. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
					' = ' . $db->quoteName('suni.university_id') . ' AND ' . $db->quoteName('suni.Committee') . " = 'Committee'")
				->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user_id));

			$db->setQuery($committee_check);
			$results = $db->loadResult();
			// If results = 1 then the user is commitee.

			if ($results == 1) {
				$status = 'No agreement, and is committee';
				// Committee to sign agreement
			}
else {
				// Show page saying please get committee to sign agreement
				$status = 'No agreement, and is NOT committee';
			}
		}

		JFactory::getApplication()->enqueueMessage('The user ID is: ' . $user_id);
		JFactory::getApplication()->enqueueMessage($status);

		/*
		$allGroups is a string containing all the groups
		Write to txt file
		Set cookie for the same
		*/
	}
}


