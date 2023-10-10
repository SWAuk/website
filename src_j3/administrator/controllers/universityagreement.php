<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * University_Agreements list controller class.
 */
class SwaControllerUniversityAgreement extends SwaControllerAdmin
{
	public function __construct()
	{
		$this->view_list = 'universityagreements';
		parent::__construct();
	}


}
