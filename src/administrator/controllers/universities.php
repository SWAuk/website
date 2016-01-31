<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Universities list controller class.
 */
class SwaControllerUniversities extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 */
	public function getModel( $name = 'university', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}