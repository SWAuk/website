<?php

// No direct access.
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * Instructors list controller class.
 */
class SwaControllerInstructors extends JControllerAdmin {
	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel( $name = 'instructor', $prefix = 'SwaModel' ) {
		$model = parent::getModel( $name, $prefix, array( 'ignore_request' => true ) );
		return $model;
	}

}