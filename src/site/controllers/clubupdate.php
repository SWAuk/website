<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerClubUpdate extends SwaController
{

	public function submit()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		/** @var SwaModelMemberDetails $model */
		$model = $this->getModel('ClubUpdate');

		$db = JFactory::getDbo();
		$committee_check = $db->getQuery(true);

		$member = $model->getMember();

		if (!is_object($member)) {
			throw new Exception('You must be a member to view this page.');
		}

		$app = JFactory::getApplication();
		$input = $app->input;
		$data = $input->getArray();

		$submittedMemberId = $data['id'];

		if ($submittedMemberId != $member->id) {
			throw new Exception('You\'re trying to submit data for someone else?. You submitted (' . $submittedMemberId . "," . $member->id . ")");
		}

		$committee_check
			->select("smem.user_id, suni.university_id, CASE WHEN suni.Committee = 'Committee' THEN 1 ELSE 0 END as 'IsCommittee', agr.id")
			->from($db->quoteName('#__swa_member', 'smem'))
			->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
				. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
				' = ' . $db->quoteName('suni.university_id'))
			->join('LEFT', $db->quoteName('#__university_agreements', 'agr') . " ON " .
				$db->quoteName('smem.university_id') . ' = ' . $db->quoteName('agr.university_id')
			)
			->where($db->quoteName('smem.id') . ' = ' . $db->quote($member->id));
		$db->setQuery($committee_check);
		$results = $db->loadRow();

		if (!is_null($results)) {
			$member_id = $results[0];
			$club_id = $results[1];
			$is_commitee = $results[2];
			$agreement_id = $results[3];
		}

		$club_name = $data['jform']['club_name'];
		$au_postcode = $data['jform']['au_postcode'];
		$club_email_1 = $data['jform']['club_email_1'];
		$club_email_1_confirm = $data['jform']['club_email_1_confirm'];
		$club_email_2 = $data['jform']['club_email_2'];
		$club_email_2_confirm = $data['jform']['club_email_2_confirm'];
		$club_contact_name = $data['jform']['club_contact_name'];
		$club_contact_method = $data['jform']['club_contact_method'];
		$club_contact_value = $data['jform']['club_contact_value'];
		$club_contact_value_confirm = $data['jform']['club_contact_value_confirm'];
		$club_information_agree = $data['jform']['club_information_agree'];
		$club_agreements_agree = $data['jform']['club_agreements_agree'];
		$au_address = $data['jform']['au_address'];
		$au_additional_address = $data['jform']['au_additional_address'];
		$club_contact_agree = $data['jform']['club_contact_agree'];

		JLog::add("The club update form has been submitted", JLog::INFO, 'clubupdate');

		// Check confirmations
		$valid = false;
		if (($club_email_1 === $club_email_1_confirm)
			&& ($club_email_2 == $club_email_2_confirm)
			&& ($club_contact_value === $club_contact_value_confirm)
			&& $is_commitee = 1) {
			$valid = true;
		}
		if (!$valid) {
			// Some characters are as HTMLCharset codes because enqueueMessage method runs toLower
			if ($is_commitee != 1) {
				$app->enqueueMessage('<img width="100%" src="https://c.tenor.com/LyWJkflY0y4AAAAC/thank-you-no-thank-you.gif"
alt="thank you but no thank you gif">', '&#84;hank you for your response, unfortunately you are not committee,
so we will not read your response.');
			}
else {
				$app->enqueueMessage('
<img width="30%" src="https://c.tenor.com/xbmcP2sjrOcAAAAC/madagascar-skipper.gif" alt="madagascar skipper waving" ',
					'&#80;lease check the details and resubmit.');
							$app->redirect(JRoute::_('index.php?option=com_swa&view=clubupdate'));
			}
		}

		if ($valid) {
			$date = new JDate;
			$date = $date->format("Y-m-d");
//		update the agreement if it exists.
			if (!is_null($agreement_id)) {
				// Need to create an agreement
				$create_update_query = $db->getQuery(true)
					->update($db->qn('#__university_agreements'))
					->where('id=' . $agreement_id)
					->set('member_id = ' . $member_id)
					->set('date = ' . $db->quote($date))
					->set('override = 0')
					->set('signed = 1');
			}
else {
				// Need to update agreement
				$create_update_query = $db->getQuery(true)
					->insert($db->qn('#__university_agreements'))
					->columns([
						$db->qn('signed'),
						$db->qn('date'),
						$db->qn('university_id'),
						$db->qn('member_id'),
						$db->qn('override'),
					])->values(implode(',', [1, $db->quote($date), $club_id, $member_id, 0]));
			}
			$db->setQuery($create_update_query);

			if (!$db->execute()) {
				JLog::add(
					__CLASS__ . ' failed to update club details: ' . $club_id,
					JLog::INFO,
					'com_swa'
				);
			}
else {
				$this->logAuditFrontend('Updated club details ' . $club_id);
			}

			// Updating university details in db
			$update_query = $db->getQuery(true)
				->update($db->qn('#__swa_university', 'suni'))
				->set('suni.au_address = ' . $db->quote($au_address))
				->set('suni.au_additional_address = ' . $db->quote($au_additional_address))
				->set('suni.au_postcode = ' . $db->quote($au_postcode))
				->set('suni.club_email_1 = ' . $db->quote($club_email_1))
				->set('suni.club_email_2 = ' . $db->quote($club_email_2))
				->set('suni.club_contact_name = ' . $db->quote($club_contact_name))
				->set('suni.club_contact_method = ' . $db->quote($club_contact_method))
				->set('suni.club_contact_value = ' . $db->quote($club_contact_value))
                ->where('suni.id = ' . $db->quote($club_id));
		}

		$db->setQuery($update_query);

		if (!$db->execute()) {
			JLog::add(
				__CLASS__ . ' failed to update club details on university table: ' . $club_id,
				JLog::INFO,
				'com_swa'
			);
		}
else {
			$this->logAuditFrontend('Updated club details on university ' . $club_id);
		}
		$app->enqueueMessage('<img width="100%" src="https://c.tenor.com/98MF-TLHnv0AAAAC/wind-surf-wind-skate-board.gif" alt="thank you">', '&#84;hank you for your response!');

	}

}
