<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View class for a list of Swa.
 */
class SwaViewRacetypes extends JViewLegacy {

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

		require_once JPATH_COMPONENT . '/helpers/swa.php';
		SwaHelper::addSubmenu( 'racetypes' );

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
		$state = $this->get( 'State' );
		$canDo = SwaHelper::getActions( $state->get( 'filter.category_id' ) );

		JToolBarHelper::title( JText::_( 'Race types' ), 'racetypes.png' );

		//Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/racetype';
		if ( file_exists( $formPath ) ) {

			if ( $canDo->get( 'core.create' ) ) {
				JToolBarHelper::addNew( 'racetype.add', 'JTOOLBAR_NEW' );
			}

			if ( $canDo->get( 'core.edit' ) && isset( $this->items[0] ) ) {
				JToolBarHelper::editList( 'racetype.edit', 'JTOOLBAR_EDIT' );
			}
		}

		JToolBarHelper::deleteList( '', 'racetypes.delete', 'JTOOLBAR_DELETE' );

		if ( $canDo->get( 'core.admin' ) ) {
			JToolBarHelper::preferences( 'com_swa' );
		}

		//Set sidebar action - New in 3.0
		JHtmlSidebar::setAction( 'index.php?option=com_swa&view=racetypes' );

		$this->extra_sidebar = '';

	}

	protected function getSortFields() {
		return array(
			'a.id' => JText::_( 'JGRID_HEADING_ID' ),
			'a.name' => JText::_( 'Name' ),
		);
	}

}
