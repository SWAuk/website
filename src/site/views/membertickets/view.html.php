<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

class SwaViewMemberTickets extends JViewLegacy {

	protected $state;
	protected $member;
	protected $params;
	protected $user;
	protected $items;

	public function display( $tpl = null ) {
		$app = JFactory::getApplication();

		$this->user = JFactory::getUser();
		$this->state = $this->get( 'State' );
		$this->params = $app->getParams( 'com_swa' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		// If not logged in
		if ( $this->user->id === 0 ) {
			$url = 'index.php?option=com_users';
			$url .= '&return=' . base64_encode( JURI::getInstance()->toString() );
			$app->redirect( JRoute::_( $url, false ) );
		}

		$this->member = $this->get( 'Member' );
		if ( !is_object( $this->member ) ) {
			throw new Exception( 'You must be a member to view this page.' );
		}
		if ( !$this->member->paid ) {
			$app->redirect( JRoute::_( 'index.php?option=com_swa&view=memberpayment' ) );
		}

		$this->items = $this->get( 'Items' );

		parent::display( $tpl );
	}

}
