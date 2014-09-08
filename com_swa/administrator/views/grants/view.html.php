<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View class for a list of Swa.
 */
class SwaViewGrants extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$this->state = $this->get( 'State' );
		$this->items = $this->get( 'Items' );
		$this->pagination = $this->get( 'Pagination' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		SwaHelper::addSubmenu( 'grants' );

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display( $tpl );
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.6
	 */
	protected function addToolbar() {
		require_once JPATH_COMPONENT . '/helpers/swa.php';

		$state = $this->get( 'State' );
		$canDo = SwaHelper::getActions( $state->get( 'filter.category_id' ) );

		JToolBarHelper::title( JText::_( 'Grants' ), 'grants.png' );

		//Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/grant';
		if ( file_exists( $formPath ) ) {

			if ( $canDo->get( 'core.create' ) ) {
				JToolBarHelper::addNew( 'grant.add', 'JTOOLBAR_NEW' );
			}

			if ( $canDo->get( 'core.edit' ) && isset( $this->items[0] ) ) {
				JToolBarHelper::editList( 'grant.edit', 'JTOOLBAR_EDIT' );
			}
		}

		JToolBarHelper::deleteList( '', 'deposits.delete', 'JTOOLBAR_DELETE' );

		if ( $canDo->get( 'core.admin' ) ) {
			JToolBarHelper::preferences( 'com_swa' );
		}

		//Set sidebar action - New in 3.0
		JHtmlSidebar::setAction( 'index.php?option=com_swa&view=grants' );

		$this->extra_sidebar = '';

	}

	protected function getSortFields() {
		return array(
			'a.id' => JText::_( 'JGRID_HEADING_ID' ),
			'a.application_date' => JText::_( 'Application date' ),
			'a.amount' => JText::_( 'Amount' ),
			'a.finances_date' => JText::_( 'Finances date' ),
			'a.auth_date' => JText::_( 'Auth date' ),
			'a.payment_date' => JText::_( 'Payment date' ),
		);
	}

}
