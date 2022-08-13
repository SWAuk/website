<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Factory;

class SwaViewFClubUpdate extends HtmlView
{
	public function display($tpl = null)
	{
		if (!$this->form = $this->get('clubupdate'))
		{
			echo "Can't load form<br>";

			return;
		}
		parent::display($tpl);	// this will include the layout file edit.php
	}
}
