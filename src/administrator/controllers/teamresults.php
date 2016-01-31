<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Teamresults list controller class.
 */
class SwaControllerTeamresults extends SwaControllerAdmin {
	/**
	 * Proxy for getModel.
	 */
	public function getModel( $name = 'teamresult', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );

		return $model;
	}

}