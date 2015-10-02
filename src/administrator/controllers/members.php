<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Members list controller class.
 */
class SwaControllerMembers extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel( $name = 'member', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}