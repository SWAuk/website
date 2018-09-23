<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Seasons list controller class.
 */
class SwaControllerSeasons extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'season', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
