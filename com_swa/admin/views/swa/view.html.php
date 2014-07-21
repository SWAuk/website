<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * SWA View
 */
class SWAViewSWA extends JViewLegacy
{
	/**
	 * SWA view display method
	 *
	 * @param null|string $tpl
	 *
	 * @return void
	 */
	function display($tpl = null)
	{
//		// Get data from the model
//		$items = $this->get('Items');
//		$pagination = $this->get('Pagination');
//
//		// Check for errors.
//		if (count($errors = $this->get('Errors')))
//		{
//			JError::raiseError(500, implode('<br />', $errors));
//			return false;
//		}
//		// Assign data to the view
//		$this->items = $items;
//		$this->pagination = $pagination;

		// Display the template
		parent::display($tpl);
	}
}