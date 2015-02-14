<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Competitiontype controller class.
 */
class SwaControllerCompetitiontype extends JControllerForm {

	function __construct() {
		$this->view_list = 'competitiontypes';
		parent::__construct();
	}

}