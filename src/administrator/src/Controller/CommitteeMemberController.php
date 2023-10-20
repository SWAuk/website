<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class CommitteeMemberController extends SwaFormController
{

	public function __construct()
	{
		$this->view_list = 'committeemembers';
		parent::__construct();
	}

}
