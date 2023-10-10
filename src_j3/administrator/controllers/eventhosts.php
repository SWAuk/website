<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SwaControllerEventhosts extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'eventhost', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
