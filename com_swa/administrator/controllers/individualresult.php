<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Individualresult controller class.
 */
class SwaControllerIndividualresult extends JControllerForm {

	function __construct() {
		$this->view_list = 'individualresults';
		parent::__construct();
	}

}