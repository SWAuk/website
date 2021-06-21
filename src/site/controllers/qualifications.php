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

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.*');
		$query->from('#__swa_qualification as a');
		$query->where('id=' . $db->quote($qualificationId));
		$db->setQuery($query);

		if (!$db->execute())
		{
			$input->enqueueMessage('Something went wrong selecting the image', 'error');
			$input->redirect(JRoute::_('index.php'));
		}

		$qualification = $db->loadObject();

		$currentMember = $this->getCurrentMember();

		if (!$currentMember->id)
		{
			$input->enqueueMessage('Couldn\'t get member id to view qualification image', 'error');
			$input->redirect(JRoute::_('index.php'));
		}

		if ($qualification->member_id != $currentMember->id)
		{
			$input->enqueueMessage('Tried to get qualification image for another member...', 'error');
			$input->redirect(JRoute::_('index.php'));
		}

		// Output the file
		header("Content-type: " . $qualification->file_type);
		print($qualification->file);
		exit();
	}

	public function checkUniqueQualification($data)
	{
		// Make sure the member does not have this qualification in the DB already
		$app = JFactory::getApplication();
		$currentMember = $this->getCurrentMember();

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('COUNT(*)');
		$query->from($db->quoteName('#__swa_qualification') . ' as qual');
		$query->where('qual.member_id = ' . $db->quote($currentMember->id));
		$query->where('qual.type = ' . $db->quote($data['type']));
		$db->setQuery($query);
		$count = $db->loadResult();

		if ($count >= 1) {
			$app->enqueueMessage('Qualification already in database, contact <a href="mailto:webmaster@swa.co.uk">webmaster@swa.co.uk</a> if you think there is an error', 'error');
			$app->redirect(JRoute::_('index.php'));
		}
	}

	public function add()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app = JFactory::getApplication();

		// Get the file uploaded
		$file = JFactory::getApplication()->input->files->get('jform');
		$file = $file['file_upload'];

		if ($file['error'] !== 0)
		{
			$app->enqueueMessage('An error occurred uploading the file, contact <a href="mailto:webmaster@swa.co.uk">webmaster@swa.co.uk</a> if the problem persists', 'error');
			$app->redirect(JRoute::_('index.php'));
		}

		$filePath = $file['tmp_name'];

		if (!file_exists($filePath))
		{
			$app->enqueueMessage('Couldn\'t find uploaded file, contact <a href="mailto:webmaster@swa.co.uk">webmaster@swa.co.uk</a> if the problem persists', 'error');
			$app->redirect(JRoute::_('index.php'));
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
			$app->enqueueMessage('Couldn\'t retrieve member id to add qualification, contact <a href="mailto:webmaster@swa.co.uk">webmaster@swa.co.uk</a> if the problem persists', 'error');
			$app->redirect(JRoute::_('index.php'));
		}

		$expiryDate = date('Y-m-d', strtotime($data['expiry_date']));

		if (new DateTime($expiryDate) < new DateTime)
		{
			$app->enqueueMessage('Expiry Date can not be in the past!', 'error');
			$app->redirect(JRoute::_('index.php'));
		}

		$this->checkUniqueQualification($data);

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

		$app->enqueueMessage('Qualification successfully uploaded!', 'message');
		$app->redirect(JRoute::_('index.php'));
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
