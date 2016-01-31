<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Damages list controller class.
 */
class SwaControllerDamages extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 */
	public function getModel( $name = 'damage', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}