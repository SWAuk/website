<?php

use Joomla\CMS\Factory;
use SwaUK\Component\Swa\Administrator\View\Home\HtmlView as BaseHtmlView;

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class HtmlView extends BaseHtmlView
{
	protected $state;

	protected $items;

	protected $params;

	public function display($tpl = null)
	{
		$app = Factory::getApplication();

		$this->state  = $this->get('State');
		$this->params = $app->getParams('com_swa');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->items = $this->get('Items');

		parent::display($tpl);
	}

}
