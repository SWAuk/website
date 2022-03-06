<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * University_Agreements list controller class.
 */
class SwaControllerUniversity_Agreements extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'University_Agreements', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
