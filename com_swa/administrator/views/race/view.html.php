<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to edit
 */
class SwaViewRace extends JViewLegacy {

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

		JToolBarHelper::title( JText::_( 'Race' ), 'race.png' );

		JToolBarHelper::apply( 'race.apply', 'JTOOLBAR_APPLY' );
		JToolBarHelper::save( 'race.save', 'JTOOLBAR_SAVE' );
		JToolBarHelper::custom( 'race.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false );

		// If an existing item, can save to a copy.
		if ( !$isNew ) {
			JToolBarHelper::custom( 'race.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false );
		}
		if ( empty( $this->item->id ) ) {
			JToolBarHelper::cancel( 'race.cancel', 'JTOOLBAR_CANCEL' );
		} else {
			JToolBarHelper::cancel( 'race.cancel', 'JTOOLBAR_CLOSE' );
		}
	}

}
