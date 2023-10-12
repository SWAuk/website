<?php

use SwaUK\Component\Swa\Administrator\Controller\SwaFormController;

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SwaCommiteeMemberController extends SwaFormController
{

	public function __construct()
	{
		$this->view_list = 'committeemembers';
		parent::__construct();
	}

}
