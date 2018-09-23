<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Competitions list controller class.
 */
class SwaControllerCompetitions extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'competition', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
