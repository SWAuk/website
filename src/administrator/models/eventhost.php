<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelEventhost extends JModelAdmin {
	/**
	 * @var        string    The prefix to use with controller messages.
	 */
	protected $text_prefix = 'COM_SWA';

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param string $type The table type to instantiate
	 * @param string $prefix A prefix for the table class name. Optional.
	 * @param array $config Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 */
	public function getTable( $type = 'Eventhost', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * Method to get the record form.
	 *
	 * @param    array $data An optional array of data for the form to interogate.
	 * @param    boolean $loadData True if the form is to load its own data (default case), false
	 *     if not.
	 *
	 * @return    JForm    A JForm object on success, false on failure
	 */
	public function getForm( $data = array(), $loadData = true ) {
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form =
			$this->loadForm(
				'com_swa.eventhost',
				'eventhost',
				array( 'control' => 'jform', 'load_data' => $loadData )
			);

		if ( empty( $form ) ) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return    mixed    The data for the form.
	 */
	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState( 'com_swa.edit.eventhost.data', array() );

		if ( empty( $data ) ) {
			$data = $this->getItem();

		}

		return $data;
	}

}