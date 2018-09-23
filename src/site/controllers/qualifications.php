<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerQualifications extends SwaController
{

	public function viewImage()
	{
		// Check for request forgeries.
		// JSession::checkToken() or jexit( JText::_( 'JINVALID_TOKEN' ) );

		$input           = JFactory::getApplication()->input;
		$data            = $input->getArray();
		$qualificationId = $data['qualification'];

		// TODO get qualification
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('a.*');
		$query->from('#__swa_qualification as a');
		$query->where('id=' . $db->quote($qualificationId));

		$db->setQuery($query);

		if (!$db->execute())
		{
			die('something went wrong selecting the image');
		}

		$qualification = $db->loadObject();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->id)
		{
			die('Coudnln\'t get member id to view qualification image');
		}

		if ($qualification->member_id != $currentMember->id)
		{
			die('Trying to get qualfiication image for other member..');
		}

		// Output the file?
		header("Content-type: " . $qualification->file_type);
		print($qualification->file);
		exit();
	}

	public function add()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Get the file uploaded
		$file = JFactory::getApplication()->input->files->get('jform');
		$file = $file['file_upload'];

		if ($file['error'] !== 0)
		{
			die('Got an error while uploading file');
		}

		$filePath = $file['tmp_name'];

		if (!file_exists($filePath))
		{
			die('Couldn\'t find uploaded file!');
		}

		$fileType = $file['type'];

		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data  = $input->getArray();
		$data  = $data['jform'];

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->id)
		{
			die('Coudnln\'t get member id to add qualification');
		}

		$expiryDate = date('Y-m-d', strtotime($data['expiry_date']));

		if (new DateTime($expiryDate) < new DateTime)
		{
			die('Expiry date can not be in the past!');
		}

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Load the file to add to the db
		$fp   = fopen($filePath, 'r');
		$file = fread($fp, filesize($filePath));
		fclose($fp);

		$columns = array('member_id', 'type', 'expiry_date', 'file', 'file_type');
		$values  = array(
			$db->quote($currentMember->id),
			$db->quote($data['type']),
			$db->quote($expiryDate),
			$db->quote($file),
			$db->quote($fileType),
		);

		$query
			->insert($db->quoteName('#__swa_qualification'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);

		if (!$db->execute())
		{
			JLog::add(
				__CLASS__ . ' failed to add qualification: Member:' . $currentMember->id,
				JLog::INFO,
				'com_swa'
			);
		}
		else
		{
			$this->logAuditFrontend('added qualification: ' . $data['type']);
		}

		$this->setRedirect(
			JRoute::_('index.php?option=com_swa&view=qualifications', false)
		);
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
		$query->select('a.*');
		$query->from($db->quoteName('#__swa_member') . ' AS a');
		$query->where('a.user_id = ' . $db->quote($user->id));

		// Load the result
		$db->setQuery($query);

		return $db->loadObject();
	}

}
