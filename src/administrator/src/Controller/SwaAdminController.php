<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\AdminController;

class SwaAdminController extends AdminController
{
	/**
	 * Extends the postDeleteHook function to log which items were delted.
	 * This is done for all classes the inherit SwaControllerAdmin.
	 *
	 * @param    JModelLegacy $model The data model object
	 * @param    int[]|null   $ids   The array of ids for items being deleted
	 *
	 * @return    void
	 */
	public function postDeleteHook(JModelLegacy $model, $ids = null): void {
		parent::postDeleteHook($model, $ids);

		$user_name = Factory::getApplication()->getIdentity()->name;
		$class     = get_called_class();
		$ids       = implode(', ', $ids);

		Log::add("{$user_name} {$class}::delete [{$ids}]", Log::INFO, 'com_swa.audit_backend');
	}

}
