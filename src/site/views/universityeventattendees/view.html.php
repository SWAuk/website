<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SwaViewUniversityEventAttendees extends JViewLegacy
{
	protected $state;

	protected $items;

	protected $params;

	protected $user;

	protected $member;

	public function display($tpl = null)
	{
		$app = JFactory::getApplication();

		$this->state  = $this->get('State');
		$this->params = $app->getParams('com_swa');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->user = JFactory::getUser();

		// If not logged in
		if ($this->user->id === 0)
		{
			$url = 'index.php?option=com_users';
			$url .= '&return=' . base64_encode(JURI::getInstance()->toString());
			$app->redirect(JRoute::_($url, false));
		}

		$this->member = $this->get('Member');

		if (!is_object($this->member))
		{
			throw new Exception('You must be a member to view this page.');
		}

		if (!$this->member->club_committee)
		{
			throw new Exception('You must be a committee member to view this page.');
		}

		$this->items = $this->get('Items');

		parent::display($tpl);
	}

}
