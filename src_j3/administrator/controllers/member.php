<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Member controller class.
 */
class SwaControllerMember extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'members';
		parent::__construct();
	}

}
