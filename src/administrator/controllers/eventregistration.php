<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Deposit controller class.
 */
class SwaControllerEventregistration extends SwaControllerForm
{

	function __construct()
	{
		$this->view_list = 'eventregistrations';
		parent::__construct();
	}

}
