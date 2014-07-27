<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Eventticket controller class.
 */
class SwaControllerEventticket extends JControllerForm {

	function __construct() {
		$this->view_list = 'eventtickets';
		parent::__construct();
	}

}