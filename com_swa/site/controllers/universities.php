<?php
// No direct access.
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

/**
 * Universities list controller class.
 */
class SwaControllerUniversities extends SwaController {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function &getModel( $name = 'Universities', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );
		return $model;
	}
}