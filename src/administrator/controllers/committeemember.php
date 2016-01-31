<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

class SwaControllerCommitteeMember extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'committeemembers';
		parent::__construct();
	}

}