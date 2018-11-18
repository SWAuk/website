<?php

defined('_JEXEC') or die;

/**
 * View to edit Membership
 */
class SwaViewMembership extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->item  = $this->get('Item');
		$this->form  = $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		$isNew = $this->item->id == 0;

		$title = ($isNew) ? 'Create Membership' : 'Edit Membership';
		JToolbarHelper::title(JText::_($title), 'membership.png');
		JToolbarHelper::apply('membership.apply', 'JTOOLBAR_APPLY');
		JToolbarHelper::save('membership.save', 'JTOOLBAR_SAVE');
		JToolbarHelper::cancel('membership.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

		JToolBarHelper::custom(
			'membership.save2new',
			'save-new.png',
			'save-new_f2.png',
			'JTOOLBAR_SAVE_AND_NEW',
			false
		);

		// If an existing item, can save to a copy.
		if (!$isNew)
		{
			JToolBarHelper::custom(
				'membership.save2copy',
				'save-copy.png',
				'save-copy_f2.png',
				'JTOOLBAR_SAVE_AS_COPY',
				false
			);
		}
	}
}
