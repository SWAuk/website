<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerUniversityMembers extends SwaController
{

	public function approve()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Approve the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$columns = array('member_id', 'university_id');
		$values  = array(
			$db->quote($data['member_id']),
			$db->quote($targetMember->university_id)
		);

		$query
			->insert($db->quoteName('#__swa_university_member'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to approve: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('approved member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers&layout=pending', false)
		);
	}

	public function unapprove()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

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
			->where('member_id = ' . $db->quote($data['member_id']))
			->where('season.year LIKE "' . (int) $date . '%"');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to unapprove: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('unapproved member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers', false)
		);
	}

	public function graduate()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->update($db->quoteName('#__swa_university_member'))
			->where('member_id = ' . $db->quote($data['member_id']))
			->set('graduated=1');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to graduate: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('graduated member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers&layout=default', false)
		);
	}

	public function ungraduate()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->update($db->quoteName('#__swa_university_member'))
			->where('member_id = ' . $db->quote($data['member_id']))
			->set('graduated=0');

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to ungraduate: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('ungraduated member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers&layout=graduated', false)
		);
	}

	public function register()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		if (array_key_exists('member_id', $data))
		{
			$memberIds = array($data['member_id']);
		}
		elseif (array_key_exists('member_ids', $data))
		{
			$memberIds = explode('|', $data['member_ids']);
		}
		else
		{
			$memberIds = array();
		}

		foreach ($memberIds as $memberId)
		{
			$data['member_id'] = $memberId;
			$targetMember      = $this->getMember($memberId);

			if ($currentMember->university_id != $targetMember->university_id)
			{
				die('Current and target member are from different universities');
			}

			$targetEvents = $this->getEvents($data['event_id']);

			if (empty($targetEvents))
			{
				die('Event does not exist with given id');
			}

			// Add a new registration row
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			$columns = array('event_id', 'member_id');
			$values  = array(
				$db->quote($data['event_id']),
				$db->quote($memberId)
			);

			$query
				->insert($db->quoteName('#__swa_event_registration'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));

			$db->setQuery($query);

			if (!$db->execute())
			{
				JLog::add(
					'SwaControllerUniversityMembers failed to register: Event:' .
					$data['event_id'] .
					' Member:' .
					$memberId,
					JLog::INFO,
					'com_swa'
				);
			}
			else
			{
				$this->logAuditFrontend(
					'registered member ' . $memberId . ' for event ' . $data['event_id']
				);
			}

			$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
		}
	}

	public function unregister()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		$targetEvents = $this->getEvents($data['event_id']);

		if (empty($targetEvents))
		{
			die('Event does not exist with given id');
		}

		// Delete all matching registration rows
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$conditions = array(
			$db->quoteName('event_id') . ' = ' . $db->quote($data['event_id']),
			$db->quoteName('member_id') . ' = ' . $db->quote($data['member_id']),
		);

		$query->delete($db->quoteName('#__swa_event_registration'));
		$query->where($conditions);

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to unregister: Event:' .
				$data['event_id'] .
				' Member:' .
				$data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend(
				'unregistered member ' . $data['member_id'] . ' for event ' . $data['event_id']
			);
		}

		$this->setRedirect(JRoute::_('index.php?option=com_swa&view=universitymembers', false));
	}

	public function addcommittee()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->update($db->quoteName('#__swa_university_member'))
			->where('member_id = ' . $db->quote($data['member_id']))
			->set('committee=' . $db->quote('Committee'));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to promote: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('promoted member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers&layout=committee', false)
		);
	}

	public function removecommittee()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->club_committee)
		{
			die('Current member is not club committee');
		}

		$targetMember = $this->getMember($data['member_id']);

		if ($currentMember->university_id != $targetMember->university_id)
		{
			die('Current and target member are from different universities');
		}

		// Graduate the member for the university
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->update($db->quoteName('#__swa_university_member'))
			->where('member_id = ' . $db->quote($data['member_id']))
			->set('committee=' . $db->quote(''));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				'SwaControllerUniversityMembers failed to demote: Member:' . $data['member_id'],
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('demoted member ' . $data['member_id']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=universitymembers&layout=committee', false)
		);
	}

	/**
	 * @param   int $eventId
	 *
	 * @return mixed
	 */
	public function getEvents($eventId)
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
		$query->select('a.*');
		$query->from($db->quoteName('#__swa_member') . ' AS a');
		$query->where('a.id = ' . $db->quote($memberId));

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

	/**
	 * @return mixed
	 */
	public function getCurrentMember()
	{
		// Create a new query object.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$user  = JFactory::getUser();

		// Select the required fields from the table.
		$query->select('member.*');
		$query->select('membership.committee AS club_committee');
		$query->from('#__swa_member AS member');
		$query->leftJoin('#__swa_membership AS membership ON membership.member_id = member.id');
		$query->where('member.user_id = ' . $db->quote($user->id));
		$query->order('season_id desc');

		// Join on university_member

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

}
