<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelMemberRegistration extends SwaModelForm
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
		$user  = JFactory::getUser();
		$table = $this->getTable();
		$table->load(array('user_id' => $user->id));

		return $table;
	}

	/**
	 * Method to get the record form.
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form =
			$this->loadForm(
				'com_swa.memberregistration',
				'memberregistration',
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
		return JFactory::getApplication()->getUserState(
			'com_swa.edit.memberregistration.data',
			array()
		);
	}

	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id))
		{
			// Set ordering to the last item if not set
			if (@$table->ordering === '')
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__swa_member');
				$max             = $db->loadResult();
				$table->ordering = $max + 1;
			}
		}
	}

	public function save($data)
	{
		$table  = $this->getTable();
		$result = $table->bind($data);

		if (!$result)
		{
			return $result;
		}

		return JFactory::getDbo()->insertObject('#__swa_member', $table);
	}
}
