<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

class SwaControllerUniversityMembers extends JControllerAdmin {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel( $name = 'universitymember', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );
		return $model;
	}

}