<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

class SwaControllerUniversityMembers extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 */
	public function getModel( $name = 'universitymember', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}