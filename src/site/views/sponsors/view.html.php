<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SwaViewSponsors extends JViewLegacy
{
	protected $sponsors;

	protected $model;

	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$this->items = $this->get('Items');
		$this->model = $this->getModel("sponsors");
		$this->sponsors = $this->model->getItems();
		parent::display($tpl);

	}

}
