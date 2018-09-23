<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Qualifications list controller class.
 */
class SwaControllerQualifications extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'qualification', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	public function viewImage()
	{
		$input           = JFactory::getApplication()->input;
		$data            = $input->getArray();
		$qualificationId = $data['id'];

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

		// Output the file?
		header("Content-type: " . $qualification->file_type);
		print($qualification->file);
		exit();
	}

}
