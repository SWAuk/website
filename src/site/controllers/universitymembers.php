<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerUniversityMembers extends SwaController
{

	public function approve()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$memberId = $input->getInt('member_id');
		$eventId = $input->getInt('event');

		$targetMember = $this->getMember($memberId);

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Approve the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$query
			->update('#__swa_membership AS membership')
			->innerJoin('#__swa_season AS season ON season.id = membership.season_id')
			->set('approved = 1')
			->where('member_id = ' . $db->quote($memberId))
			->where('season.year LIKE "' . (int) $date . '%"');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to approve member '{$memberId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend("Approved member '{$memberId}'");
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers', false)
		);
	}

	public function unapprove()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$memberId = $input->getInt('member_id');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		// Unapprove the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$query
			->update('#__swa_membership AS membership')
			->innerJoin('#__swa_season AS season ON season.id = membership.season_id')
			->set('approved = 0')
			->where('member_id = ' . $db->quote($memberId))
			->where('season.year LIKE "' . (int) $date . '%"');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to unapprove member '{$memberId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('unapproved member ' . $memberId);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers', false)
		);
	}

	public function register()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();

		$props    = $this->getProperties();
		/** @var JInput $input */
		$input    = $props['input'];
		$memberId = $input->getInt('member_id');
		$eventId  = $input->getInt('event_id');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		if (empty($memberId))
		{
			die('You need to specify a member');
		}

		$targetMember = $this->getMember($memberId);

		if ($currentMember->uni_id !== $targetMember->uni_id)
		{
			die("Current and target member are from different universities. {$currentMember->uni_id} != {$targetMember->uni_id}");
		}

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$columns = array('event_id', 'member_id');
		$values  = array(
			$db->quote($eventId),
			$db->quote($memberId)
		);

		$query->insert($db->quoteName('#__swa_event_registration'));
		$query->columns($db->quoteName($columns));
		$query->values(implode(',', $values));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to register member '{$memberId}' for event '{$eventId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend("Registered member '{$memberId}' for event '{$eventId}'");
		}

		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	public function unregister()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();

		$props   = $this->getProperties();
		/** @var JInput $input */
		$input   = $props['input'];
		$memberId = $input->getInt('member_id');
		$eventId = $input->getInt('event_id');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($memberId);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		$targetEvent = $this->getEvent($eventId);

		if (empty($targetEvent))
		{
			die('Event does not exist with given id');
		}

		// Delete all matching registration rows
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$conditions = array(
			$db->quoteName('event_id') . ' = ' . $db->quote($eventId),
			$db->quoteName('member_id') . ' = ' . $db->quote($memberId),
		);

		$query->delete($db->quoteName('#__swa_event_registration'));
		$query->where($conditions);

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to unregister uni member '{$memberId}' from event '{$eventId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend("Unregistered member '{$memberId}' for event '{$eventId}'");
		}

		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	public function registerAll()
	{
	    // TODO: Do we need to check the token as no form is being submitted when this method is called

		// Check for request forgeries.
		// JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();
		$items		   = $model->getItems();
		$events		   = $model->getAvailableEvents();

		$props	= $this->getProperties();
		/** @var JInput $input */
		$input	 = $props['input'];
		$eventId = $input->getInt('event');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		if (empty($events) || !in_array($eventId, $events))
		{
			die('Event does not exist with given id');
		}

		$db		 = JFactory::getDbo();
		$query 	 = $db->getQuery(true);
		$columns = array('event_id', 'member_id');
		$values	 = array();

		foreach ($items as $uniMember)
		{
			if ($currentMember->uni_id != $uniMember->uni_id)
			{
				die('Current and target member are from different universities');
			}

			// Only register approved members
			if (!$uniMember->approved) {
				continue;
            }

			$values[] = "{$db->quote($eventId)}, {$db->quote($uniMember->id)}";
		}

		$query->insert($db->quoteName('#__swa_event_registration'));
		$query->columns($db->quoteName($columns));
		$query->values($values);

		$db->setQuery($query);

		if (!$db->execute())
		{
			$sql = $db->replacePrefix((string) $query);
			JLog::add(
				"SwaControllerUniversityMembers failed to register all members in Uni: '{$currentMember->uni_id }' for Event: {$eventId}. SQL: {$sql}.",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			// TODO: Update
			$this->logAuditFrontend("registered all members for event: {$eventId}");
		}

		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	// TODO: Add an unregisterAll() function?

	public function addcommittee()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$items		   = $model->getItems();
		$currentMember = $model->getMember();

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$memberId = $input->getInt('member_id');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember(memberId);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$query
			->update('#__swa_membership AS membership')
			->innerJoin('#__swa_season AS season ON season.id = membership.season_id')
			->set('committee = 1')
			->where('member_id = ' . $db->quote($memberId))
			->where('season.year LIKE "' . (int) $date . '%"');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to promote member '{$memberId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend("Promoted member '{$memberId}'");
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers', false)
		);
	}

	public function removecommittee()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model		   = $this->getModel('UniversityMembers');
		$currentMember = $model->getMember();

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$memberId = $input->getInt('member_id');

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($memberId);

		if ($currentMember->uni_id != $targetMember->uni_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$now       = time();
		$seasonEnd = strtotime("1st June");
		$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$query->update('#__swa_membership AS membership');
		$query->innerJoin('#__swa_season AS season ON season.id = membership.season_id');
		$query->set('committee = 0');
		$query->where('member_id = ' . $db->quote($memberId));
		$query->where('season.year LIKE "' . (int) $date . '%"');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				"SwaControllerUniversityMembers failed to demote member '{$memberId}'",
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend("Demoted member '{$memberId}'");
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers', false)
		);
	}

	/**
	 * @param   int $eventId
	 *
	 * @return mixed
	 */
	public function getEvent($eventId)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('a.*');
		$query->from($db->quoteName('#__swa_event') . ' AS a');
		$query->where('a.id = ' . $db->quote($eventId));

		// Load the result
		$db->setQuery($query);

		return $db->loadObjectList();
	}

	/**
	 * @param   int $memberId
	 *
	 * @return mixed
	 */
	public function getMember($memberId)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('member.*');
		$query->select('membership.uni_id AS uni_id');
		$query->from('#__swa_member AS member');
 		$query->leftJoin('#__swa_membership AS membership ON membership.member_id = member.id');
		$query->where('member.id = ' . $db->quote($memberId));

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

}
