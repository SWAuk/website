<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SwaViewEvent extends JViewLegacy
{
	protected $state;

	protected $item;

	protected $params;

	protected $user;

	protected $member;

	public function display($tpl = null)
	{
		$app = JFactory::getApplication();

		$this->user   = JFactory::getUser();
		$this->state  = $this->get('State');
		$this->params = $app->getParams('com_swa');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		// If there is no item selected (no event id passed) then go to the default list of events
		$this->item = $this->get('Item');

		if ($this->item === null)
		{
			$app->redirect(JRoute::_('index.php?option=com_swa&view=events'));
		}

		$this->member = $this->get('Member');

		parent::display($tpl);
	}

}
