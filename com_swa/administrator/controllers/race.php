<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Race controller class.
 */
class SwaControllerRace extends JControllerForm {

	function __construct() {
		$this->view_list = 'races';
		parent::__construct();
	}

}