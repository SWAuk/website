<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SwaViewClubUpdate extends JViewLegacy
{
	protected $state;

	protected $form;

	protected $params;

	protected $user;

	protected $member;

	public function display($tpl = null)
	{
		$app = JFactory::getApplication();

		$this->user   = JFactory::getUser();
		$this->state  = $this->get('State');
		$this->form   = $this->get('Form');
		$this->params = $app->getParams('com_swa');
		$this->member = $this->get('Member');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		// If not logged in
		if ($this->user->id === 0)
		{
			$url = 'index.php?option=com_users';
			$url .= '&return=' . base64_encode(JURI::getInstance()->toString());
			$app->redirect(JRoute::_($url, false));
		}

		if (!$this->member->club_committee)
		{
			throw new Exception('You must be a committee member to view this page.');
		}

		parent::display($tpl);
	}

}
