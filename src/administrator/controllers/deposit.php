<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Deposit controller class.
 */
class SwaControllerDeposit extends SwaControllerForm
{

	function __construct()
	{
		$this->view_list = 'deposits';
		parent::__construct();
	}

}
