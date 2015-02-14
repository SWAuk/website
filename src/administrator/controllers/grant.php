<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Grant controller class.
 */
class SwaControllerGrant extends JControllerForm {

	function __construct() {
		$this->view_list = 'grants';
		parent::__construct();
	}

}