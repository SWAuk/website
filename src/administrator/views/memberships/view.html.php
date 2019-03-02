<?php

defined('_JEXEC') or die;

/**
 * View class for a list of Swa.
 */
class SwaViewMemberships extends JViewLegacy
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
		SwaHelper::addSubmenu('memberships');

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
		$actions = SwaHelper::getActions();

		JToolBarHelper::title(JText::_('Memberships'), 'memberships.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/membership';
		if (file_exists($formPath))
		{
			if ($actions->get('core.create'))
			{
				JToolBarHelper::addNew('membership.add', 'JTOOLBAR_NEW');
			}

			if ($actions->get('core.edit') && !empty($this->items))
			{
				JToolBarHelper::editList('membership.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($actions->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'memberships.delete', 'JTOOLBAR_DELETE');
		}

		if ($actions->get('core.admin'))
		{
			JToolBarHelper::preferences('com_swa');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_swa&view=memberships');

		$this->extra_sidebar = '';
	}

	protected function getSortFields()
	{
		return array(
			'season desc, member.id' => JText::_('Season, Member ID'),
			'season'                 => JText::_('Season'),
			'member_name'            => JText::_('Member'),
			'member.id'              => JText::_('Member ID'),
			'paid'                   => JText::_('Paid'),
			'level'                  => JText::_('Level'),
			'university'             => JText::_('University'),
			'approved'               => JText::_('Approved'),
			'committee'              => JText::_('Committee'),
		);
	}

}
