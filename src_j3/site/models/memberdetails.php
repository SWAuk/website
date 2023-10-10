<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelMemberDetails extends SwaModelForm
{

	public function getTable($type = 'Member', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @return JTable
	 */
	public function getItem()
	{
		return $this->getMember();
	}

	/**
	 * Method to get the record form.
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form =
			$this->loadForm(
				'com_swa.memberdetails',
				'memberdetails',
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
				'com_swa.edit.memberdetails.data',
				array()
			);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}
