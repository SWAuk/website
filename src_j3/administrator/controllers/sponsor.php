<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Sponsor controller class.
 */
class SwaControllerSponsor extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'sponsors';
		parent::__construct();
	}

}
