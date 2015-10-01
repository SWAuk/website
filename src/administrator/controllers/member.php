<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Member controller class.
 */
class SwaControllerMember extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'members';
		parent::__construct();
	}

}