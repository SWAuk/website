<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

class SwaControllerUniversityMember extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'universitymembers';
		parent::__construct();
	}

}