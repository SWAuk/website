<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Memberships list controller class.
 */
class SwaControllerMemberships extends SwaControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 */
	public function getModel($name = 'Membership', $prefix = 'SwaModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

}
