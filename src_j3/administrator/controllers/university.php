<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * University controller class.
 */
class SwaControllerUniversity extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'universities';
		parent::__construct();
	}

}
