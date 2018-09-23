<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SwaControllerUniversityMember extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'universitymembers';
		parent::__construct();
	}

}
