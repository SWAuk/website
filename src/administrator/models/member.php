<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelMember extends JModelAdmin
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 */
	protected $text_prefix = 'COM_SWA';

//	protected function populateState()
//	{
//		$app = JFactory::getApplication();
//
//		// Get member id
//		$id = $app->input->get('id', 1, 'INT');
//		$this->setState('member.id', $id);
//
//		// Load the parameters.
//		$this->setState('params', $app->getParams());
//
//		parent::populateState();
//	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string $type   The table type to instantiate
	 * @param   string $prefix A prefix for the table class name. Optional.
	 * @param   array  $config Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 */
	public function getTable($type = 'Member', $prefix = 'SwaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array   $data     An optional array of data for the form to interogate.
	 * @param   boolean $loadData True if the form is to load its own data (default case), false
	 *                            if not.
	 *
	 * @return    JForm    A JForm object on success, false on failure
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form =
			$this->loadForm(
				'com_swa.member',
				'member',
				array('control' => 'jform', 'load_data' => $loadData)
			);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return    mixed    The data for the form.
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_swa.edit.member.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

//	public function getItem($pk = null)
//	{
//		if (!isset($this->item))
//		{
//			$id    = $this->getState('member.id');
//
//			$db    = JFactory::getDbo();
//			$query = $db->getQuery(true);
//
//			$query->select('member.*');
//			$query->from('#__swa_mamber AS member');
//			$query->where('member.id = ' . (int) $id);
//
//			$db->setQuery((string)$query);
//
//		}
//	}

}
