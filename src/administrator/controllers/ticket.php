<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Ticket controller class.
 */
class SwaControllerTicket extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'tickets';
		parent::__construct();
	}

}