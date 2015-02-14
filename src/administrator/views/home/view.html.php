<?php
// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to use as default home
 */
class SwaViewHome extends JViewLegacy {

	// Overwriting JView display method
	function display( $tpl = null ) {

		JToolBarHelper::title( JText::_( 'SWA home' ) );

		SwaHelper::addSubmenu( 'home' );
		$this->sidebar = JHtmlSidebar::render();

		// Assign data to the view
		$this->header = 'Welcome!';
		$this->message = 'Nothing is here yet, please use the menu to select the correct view.';

		// Display the view
		parent::display( $tpl );
	}

}
