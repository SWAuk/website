<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelClubUpdate extends SwaModelForm
{


	/**
	 * Method to get the record form.
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form =
			$this->loadForm(
				'com_swa.clubupdate',
				'clubupdate',
				array('control' => 'jform', 'load_data' => $loadData)
			);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data =
			JFactory::getApplication()->getUserState(
				'com_swa.edit.clubupdate.data',
				array()
			);

		return $data;
	}
}
