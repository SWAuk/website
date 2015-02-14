<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Deposit controller class.
 */
class SwaControllerDeposit extends JControllerForm {

	function __construct() {
		$this->view_list = 'deposits';
		parent::__construct();
	}

}