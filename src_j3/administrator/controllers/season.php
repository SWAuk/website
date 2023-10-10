<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Season controller class.
 */
class SwaControllerSeason extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'seasons';
		parent::__construct();
	}

}
