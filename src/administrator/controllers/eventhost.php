<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SwaControllerEventhost extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'eventhosts';
		parent::__construct();
	}

}
