<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Event controller class.
 */
class SwaControllerEvent extends SwaControllerForm
{

	function __construct()
	{
		$this->view_list = 'events';
		parent::__construct();
	}

}
