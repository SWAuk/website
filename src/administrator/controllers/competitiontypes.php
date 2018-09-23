<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Competitiontypes list controller class.
 */
class SwaControllerCompetitiontypes extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'competitiontype', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
