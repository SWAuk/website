<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Racetype controller class.
 */
class SwaControllerRacetype extends JControllerForm {

	function __construct() {
		$this->view_list = 'racetypes';
		parent::__construct();
	}

}