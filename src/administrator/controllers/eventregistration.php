<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Deposit controller class.
 */
class SwaControllerEventregistration extends JControllerForm {

	function __construct() {
		$this->view_list = 'eventregistrations';
		parent::__construct();
	}

}