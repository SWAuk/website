<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Event controller class.
 */
class SwaControllerEvent extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'events';
		parent::__construct();
	}

}
