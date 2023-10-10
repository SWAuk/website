<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to use as default home
 */
class SwaViewHome extends JViewLegacy
{

	// Overwriting JView display method
	public function display($tpl = null)
	{

		JToolBarHelper::title(JText::_('SWA home'));

		SwaHelper::addSubmenu('home');
		$this->sidebar = JHtmlSidebar::render();

		// Display the view
		parent::display($tpl);
	}

}
