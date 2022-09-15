<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * University_Agreements list controller class.
 */
class SwaControllerUniversityAgreements extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'UniversityAgreements', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
