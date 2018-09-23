<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Members list controller class.
 */
class SwaControllerMembers extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'member', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
