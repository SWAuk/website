<?php

namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class SwaAdminController extends AdminController {
	protected string $model_view;
	/**
	 * Extends the postDeleteHook function to log which items were delted.
	 * This is done for all classes the inherit SwaControllerAdmin.
	 *
	 * @param   JModelLegacy  $model  The data model object
	 * @param   int[]|null    $ids    The array of ids for items being deleted
	 *
	 * @return    void
	 */
	public function postDeleteHook( \JModelLegacy $model, $ids = null ): void {
		parent::postDeleteHook( $model, $ids );

		$user_name = Factory::getApplication()->getIdentity()->name;
		$class     = get_called_class();
		$ids       = implode( ', ', $ids );

		Log::add( "{$user_name} {$class}::delete [{$ids}]", Log::INFO, 'com_swa.audit_backend' );
	}

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null ) {
		parent::__construct( $config, $factory, $app, $input );
	}

	public function getModel( $name = '', $prefix = '', $config = [] ) {
		return parent::getModel( $this->model_view, $this->model_prefix, array( 'ignore_request' => true ) );
	}
}
