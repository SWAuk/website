<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelOrgCommitteeDetails extends SwaModelForm {

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable
	 */
	public function getTable($type = 'Committee', $prefix = 'SwaTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @return JTable
	 */
	public function getItem() {
		$user = JFactory::getUser();
		$table = $this->getTable();
		$table->load(array('member_id' => $user->id));
		return $table;
	}

	/**
	 * Method to get the record form.
	 */
	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_swa.orgcommitteedetails', 'orgcommitteedetails', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form)) {
			return false;
		}

		return $form;
	}

	protected function loadFormData() {
		// Check the session for previously entered form data.
		return JFactory::getApplication()->getUserState('com_swa.edit.orgcommitteedetails.data', array());
	}

	protected function prepareTable($table) {
		jimport('joomla.filter.output');
	}

	public function save($data) {
		$table = $this->getTable();
		$result = $table->bind($data);

		if (!$result) {
			return $result;
		}

		return JFactory::getDbo()->insertObject('#__swa_committee', $table);
	}

}
