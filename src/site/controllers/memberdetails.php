<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerMemberDetails extends SwaController
{

	public function submit()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		/** @var SwaModelMemberDetails $model */
		$model = $this->getModel('MemberDetails');

		$member = $model->getMember();

		if (!is_object($member))
		{
			throw new Exception('You must be a member to view this page.');
		}

		$input = JFactory::getApplication()->input;
		$data  = $input->getArray();

		$submittedMemberId = $data['jform']['id'];

		if ($submittedMemberId != $member->id)
		{
			throw new Exception('You\'re trying to submit data for someone else?');
		}

		$newSex        = $data['jform']['sex'];
		$newPronouns   = $data['jform']['pronouns'];
		$newEthnicity  = $data['jform']['ethnicity'];
		$newDob  	   = $data['jform']['dob'];
		$newTel        = $data['jform']['tel'];
		$newEContact   = $data['jform']['econtact'];
		$newENumber    = $data['jform']['enumber'];
		$newDietary    = $data['jform']['dietary'];

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->update($db->quoteName('#__swa_member'))
			->where('id = ' . $db->quote($member->id))
			->set('sex = ' . $db->quote($newSex))
			->set('pronouns = ' . $db->quote($newPronouns))
			->set('ethnicity = ' . $db->quote($newEthnicity))
			->set('dob = ' . $db->quote($newDob))
			->set('tel = ' . $db->quote($newTel))
			->set('econtact = ' . $db->quote($newEContact))
			->set('enumber = ' . $db->quote($newENumber))
			->set('dietary = ' . $db->quote($newDietary));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				__CLASS__ . ' failed to update member details: ' . $member->id,
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('Updated member details ' . $member->id);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=memberdetails&layout=default', false)
		);

	}

}
