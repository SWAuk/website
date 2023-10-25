<?php
namespace SwaUK\Component\Swa\Administrator\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class CommitteeMemberModel extends AdminModel
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 */
	protected $text_prefix = 'COM_SWA';

	/**
	 * Returns a reference to the Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return Table A database object
	 */
//	public function getTable($type = 'CommitteeMember', $prefix = 'Table', $config = array()): \Joomla\CMS\Table\Table {
//		try {
//			$table = Table::getInstance($type, $prefix, $config);
//		} catch (Exception $e) {
//			// Handle the error here, e.g., log it or throw an exception.
//			return null;
//		}
//
//		return $table;
//	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      An optional array of data for the form to interogate.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false
	 *                              if not.
	 *
	 * @return Form|false A JForm object on success, false on failure
	 * @throws Exception
	 */
	public function getForm($data = array(), $loadData = true): Form|false {
		// Get the form.
		$form =
			$this->loadForm(
				'com_swa.committeemember',
				'committeemember',
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
	protected function loadFormData(): mixed {
		// Check the session for previously entered form data.
		Log::add("LoadFormData");
		$data = Factory::getApplication()->getUserState('com_swa.edit.committeemembers.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   \JTable $table A reference to a \JTable object.
	 *
	 * @return  void
	 */
	protected function prepareTable($table): void {
		// Set ordering to the last item if not set
		if (empty($table->ordering))
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select('MAX(ordering)');
			$query->from('#__swa_committee');

			$db->setQuery($query);
			$max = $db->loadResult();

			$table->ordering = $max + 1;
		}
	}
}
