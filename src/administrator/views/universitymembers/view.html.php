<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Swa.
 */
class SwaViewUniversityMembers extends JViewLegacy
{

	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state      = $this->get('State');
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		require_once JPATH_COMPONENT . '/helpers/swa.php';
		SwaHelper::addSubmenu('universitymembers');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 */
	protected function addToolbar()
	{
		$canDo = SwaHelper::getActions();

		JToolBarHelper::title(JText::_('University Members'), 'universitymembers.png');

		//Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/universitymember';
		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('universitymember.add', 'JTOOLBAR_NEW');
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('universitymember.edit', 'JTOOLBAR_EDIT');
			}
		}

		JToolBarHelper::deleteList('', 'universitymembers.delete', 'JTOOLBAR_DELETE');

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_swa');
		}

		//Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_swa&view=universitymembers');

		$this->extra_sidebar = '';

	}

	protected function getSortFields()
	{
		return array(
			'a.id'        => JText::_('JGRID_HEADING_ID'),
			'a.graduated' => JText::_('Graduated'),
			'a.committee' => JText::_('Committee Position'),
		);
	}

}
