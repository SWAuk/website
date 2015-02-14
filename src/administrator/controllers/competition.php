<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Competition controller class.
 */
class SwaControllerCompetition extends JControllerForm {

	function __construct() {
		$this->view_list = 'competitions';
		parent::__construct();
	}

}