<?php
// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

/**
 * Swa model.
 */
class SwaModelCommitteeMember extends JModelAdmin {
	/**
	 * @var        string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_SWA';

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param    type    The table type to instantiate
	 * @param    string    A prefix for the table class name. Optional.
	 * @param    array    Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 * @since    1.6
	 */
	public function getTable( $type = 'Committee', $prefix = 'SwaTable', $config = array() ) {
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
	 * @since    1.6
	 */
	public function getForm( $data = array(), $loadData = true ) {
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form =
			$this->loadForm(
				'com_swa.committeemember',
				'committeemember',
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
	 * @since    1.6
	 */
	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data =
			JFactory::getApplication()->getUserState(
				'com_swa.edit.committeemembers.data',
				array()
			);

		if ( empty( $data ) ) {
			$data = $this->getItem();

		}

		return $data;
	}

}