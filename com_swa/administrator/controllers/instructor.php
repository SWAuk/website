<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Instructor controller class.
 */
class SwaControllerInstructor extends JControllerForm {

	function __construct() {
		$this->view_list = 'instructors';
		parent::__construct();
	}

}