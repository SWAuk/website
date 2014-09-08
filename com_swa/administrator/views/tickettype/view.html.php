<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to edit
 */
class SwaViewTickettype extends JViewLegacy {

	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$this->state = $this->get( 'State' );
		$this->item = $this->get( 'Item' );
		$this->form = $this->get( 'Form' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		$this->addToolbar();
		parent::display( $tpl );
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar() {
		JFactory::getApplication()->input->set( 'hidemainmenu', true );

		$isNew = ( $this->item->id == 0 );

		JToolBarHelper::title( JText::_( 'Ticket type' ), 'tickettype.png' );

		JToolBarHelper::apply( 'tickettype.apply', 'JTOOLBAR_APPLY' );
		JToolBarHelper::save( 'tickettype.save', 'JTOOLBAR_SAVE' );
		JToolBarHelper::custom( 'tickettype.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false );

		// If an existing item, can save to a copy.
		if ( !$isNew ) {
			JToolBarHelper::custom( 'tickettype.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false );
		}
		if ( empty( $this->item->id ) ) {
			JToolBarHelper::cancel( 'tickettype.cancel', 'JTOOLBAR_CANCEL' );
		} else {
			JToolBarHelper::cancel( 'tickettype.cancel', 'JTOOLBAR_CLOSE' );
		}
	}

}
