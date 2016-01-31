<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Competitiontype controller class.
 */
class SwaControllerCompetitiontype extends SwaControllerForm {

	function __construct() {
		$this->view_list = 'competitiontypes';
		parent::__construct();
	}

}