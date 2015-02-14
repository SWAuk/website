<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Qualification controller class.
 */
class SwaControllerQualification extends JControllerForm {

	function __construct() {
		$this->view_list = 'qualifications';
		parent::__construct();
	}

}