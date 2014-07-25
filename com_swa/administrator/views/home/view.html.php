<?php
// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to use as default home
 */
class SwaViewHome extends JViewLegacy {

	// Overwriting JView display method
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = 'SWA home... (use the menu)';

		// Display the view
		parent::display($tpl);
	}

}
