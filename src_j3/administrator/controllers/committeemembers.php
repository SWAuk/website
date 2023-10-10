<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SwaControllerCommitteeMembers extends SwaControllerAdmin
{

	public function getModel($name = 'committeemember', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
