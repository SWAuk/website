<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controllerform' );

/**
 * Damage controller class.
 */
class SwaControllerDamage extends JControllerForm {

	function __construct() {
		$this->view_list = 'damages';
		parent::__construct();
	}

}