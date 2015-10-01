<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Individualresult controller class.
 */
class SwaControllerIndividualresult extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'individualresults';
		parent::__construct();
	}

}