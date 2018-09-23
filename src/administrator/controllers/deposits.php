<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Deposits list controller class.
 */
class SwaControllerDeposits extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'deposit', $prefix = 'SwaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

}
