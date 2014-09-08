<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

class SwaViewUniversity extends JViewLegacy {

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

		$this->item = $this->get( 'Item' );

		if( is_null( $this->item ) ) {
			$app->redirect( JRoute::_( 'index.php?option=com_swa&view=memberregistration' ) );
		}

		parent::display( $tpl );
	}

}
