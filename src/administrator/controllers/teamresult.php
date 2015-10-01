<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Teamresult controller class.
 */
class SwaControllerTeamresult extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'teamresults';
		parent::__construct();
	}

}