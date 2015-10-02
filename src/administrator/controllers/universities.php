<?php
// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Universities list controller class.
 */
class SwaControllerUniversities extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel( $name = 'university', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}