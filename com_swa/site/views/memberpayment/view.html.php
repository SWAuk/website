<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

class SwaViewMemberPayment extends JViewLegacy {

	protected $state;
	protected $item;
	protected $form;
	protected $params;
	protected $user;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$app = JFactory::getApplication();

		$this->user = JFactory::getUser();
		$this->state = $this->get( 'State' );
		$this->form = $this->get( 'Form' );
		$this->params = $app->getParams( 'com_swa' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		// If not logged in
		if( $this->user->id === 0 ) {
			$url = 'index.php?option=com_users';
			$url.= '&return=' . base64_encode( JURI::getInstance()->toString() );
			$app->redirect( JRoute::_( $url, false ) );
		}
		//TODO if user is not registered go to registration
		//TODO if user has paid go to memberdetails view

		parent::display( $tpl );
	}

}
