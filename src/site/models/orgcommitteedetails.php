<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelOrgCommitteeDetails extends SwaModelForm {

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 *
	 * @return JTable
	 */
	public function getTable( $type = 'Committee', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * @return JTable
	 */
	public function getItem() {
		$member = $this->getMember();
		$table = $this->getTable();
		$table->load( array( 'member_id' => $member->id ) );

		return $table;
	}

	/**
	 * Method to get the record form.
	 */
	public function getForm( $data = array(), $loadData = true ) {
		$form =
			$this->loadForm(
				'com_swa.orgcommitteedetails',
				'orgcommitteedetails',
				array( 'control' => 'jform', 'load_data' => $loadData )
			);

		if ( empty( $form ) ) {
			return false;
		}

		return $form;
	}

	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data =
			JFactory::getApplication()->getUserState(
				'com_swa.edit.orgcommitteedetails.data',
				array()
			);

		if ( empty( $data ) ) {
			$data = $this->getItem();

		}

		return $data;
	}

	protected function prepareTable( $table ) {
		jimport( 'joomla.filter.output' );
	}

	public function save( $data ) {
		$table = $this->getTable();
		$result = $table->bind( $data );

		if ( !$result ) {
			return $result;
		}

		return JFactory::getDbo()->insertObject( '#__swa_committee', $table );
	}

}
