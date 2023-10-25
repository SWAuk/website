<?php

namespace SwaUK\Component\Swa\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;

class SwaAdminModel extends AdminModel {
	/**
	 * Returns a reference to the Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for the model. Optional.
	 *
	 * @return Table A database object
	 */
//	public function getTable($type = 'Table', $prefix = 'SwaTable', $config = array()): Table
//	{
//		return parent::getTable($type, $prefix, $config);
//	}
	protected string $form_name = '';
	private $table_name = '';

	/**
	 * Method to get the record form.
	 *
	 * @param   array  $data      An optional array of data for the form to interrogate.
	 * @param   bool   $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return Form|false A JForm object on success, false on failure
	 */
	public function getForm( $data = array(), $loadData = true ): Form|false {
		$form = $this->loadForm( 'com_swa.' . $this->form_name, $this->form_name, array( 'control'   => 'jform',
		                                                                                 'load_data' => $loadData
		) );

		if ( empty( $form ) )
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
		Log::add( "LoadFormData" );
		$data = Factory::getApplication()->getUserState( 'com_swa.edit.' . $this->form_name . '.data', array() );

		if ( empty( $data ) )
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
			$query->from( $this->table_name );

			$db->setQuery($query);
			$max = $db->loadResult();

			$table->ordering = $max + 1;
		}
	}
}
