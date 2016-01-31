<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelMemberDetails extends SwaModelForm {

	public function getTable( $type = 'Member', $prefix = 'SwaTable', $config = array() ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * @return JTable
	 */
	public function getItem() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery( true );
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName( '#__swa_member' ) . ' AS a' );
		$query->where( 'a.user_id = ' . $user->id );
		// Join over the university
		$query->select( 'b.name AS university' );
		$query->join( 'LEFT', '#__swa_university AS b ON a.university_id = b.id' );

		// Load the result
		$db->setQuery( $query );

		return $db->loadObject();
	}

	/**
	 * Method to get the record form.
	 */
	public function getForm( $data = array(), $loadData = true ) {
		$form =
			$this->loadForm(
				'com_swa.memberdetails',
				'memberdetails',
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
				'com_swa.edit.memberdetails.data',
				array()
			);

		if ( empty( $data ) ) {
			$data = $this->getItem();

		}

		return $data;
	}
}