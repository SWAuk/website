<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Grant controller class.
 */
class SwaControllerGrant extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'grants';
		parent::__construct();
	}

}
