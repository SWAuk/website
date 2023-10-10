<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Event controller class.
 */
class SwaEventController extends SwaFormController
{
	public function __construct()
	{
		$this->view_list = 'events';
		parent::__construct();
	}

}
