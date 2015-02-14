<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Season controller class.
 */
class SwaControllerSeason extends JControllerForm {

	function __construct() {
		$this->view_list = 'seasons';
		parent::__construct();
	}

}