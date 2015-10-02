<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

class SwaControllerEventhosts extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel( $name = 'eventhost', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}