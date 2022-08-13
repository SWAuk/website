<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\FormModel;

class SwaModelClubUpdate extends FormModel
{

	public function getForm($data = array(), $loadData = true)
	{
//		JFactory::getApplication()->enqueueMessage('DOB can not be in the future!', 'error');
		$form = $this->loadForm(
			'com_swa.clubupdate',  // just a unique name to identify the form
			'clubupdate',				// the filename of the XML form definition
			// Joomla will look in the models/forms folder for this file
			array(
				'control' => 'jform',	// the name of the array for the POST parameters
				'load_data' => $loadData	// will be TRUE
			)
		);

		if (empty($form))
		{
			$errors = $this->getErrors();
			throw new Exception(implode("\n", $errors), 500);
		}

		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_swa.clubupdate',	// a unique name to identify the data in the session
			array("telephone" => "0")	// prefill data if no data found in session
		);

		return $data;
	}

}
