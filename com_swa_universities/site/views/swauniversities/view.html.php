<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the SWA Component
 */
class SWAUniversitiesViewSWAUniversities extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		// TODO Assign data to the view
		$this->msg = "I am a university string TODO";

		// Display the view
		parent::display($tpl);
	}
}