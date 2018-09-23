<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Individualresult controller class.
 */
class SwaControllerIndividualresult extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'individualresults';
		parent::__construct();
	}

}
