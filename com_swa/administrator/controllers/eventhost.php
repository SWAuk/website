<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

class SwaControllerEventhost extends JControllerForm {

	function __construct() {
		$this->view_list = 'eventhosts';
		parent::__construct();
	}

}