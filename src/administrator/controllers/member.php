<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Member controller class.
 */
class SwaControllerMember extends JControllerForm {

	function __construct() {
		$this->view_list = 'members';
		parent::__construct();
	}

}