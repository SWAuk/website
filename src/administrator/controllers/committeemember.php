<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

class SwaControllerCommitteeMember extends JControllerForm {

	function __construct() {
		$this->view_list = 'committeemembers';
		parent::__construct();
	}

}