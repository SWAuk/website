<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Eventticket controller class.
 */
class SwaControllerEventticket extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'eventtickets';
		parent::__construct();
	}

}
