<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Eventtickets list controller class.
 */
class SwaControllerEventtickets extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 */
	public function getModel( $name = 'eventticket', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}