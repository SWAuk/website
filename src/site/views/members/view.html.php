<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View class for a list of Swa.
 */
class SwaViewMembers extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;
	protected $user;
	protected $member;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$app = JFactory::getApplication();

		$this->state = $this->get( 'State' );
		$this->pagination = $this->get( 'Pagination' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		$this->user = JFactory::getUser();

		// If not logged in
		if( $this->user->id === 0 ) {
			$url = 'index.php?option=com_users';
			$url.= '&return=' . base64_encode( JURI::getInstance()->toString() );
			$app->redirect( JRoute::_( $url, false ) );
		}

		$this->member = $this->get( 'Member' );
		if( !is_object( $this->member ) ) {
			//TODO better error message
			die( 'You must be a member to view this page!' );
		}
		if ( !$this->member->paid ) {
			$app->redirect( JRoute::_( 'index.php?option=com_swa&view=memberpayment' ) );
		}
		elseif( !$this->member->swa_committee ) {
			//TODO do something better here
			die( 'You need to be an SWA committee member to view this page..' );
		}

		$this->items = $this->get( 'Items' );

		parent::display( $tpl );
	}


	protected function getSortFields() {
		return array(
			'a.id' => JText::_( 'JGRID_HEADING_ID' ),
			'a.user' => JText::_( 'User' ),
			'a.university' => JText::_( 'University' ),
		);
	}

}
