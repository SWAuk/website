<?php
namespace SwaUK\Component\Swa\Administrator\View\SwaCommitteeMember;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 *
 * @copyright   Copyright (C) 2020 John Smith. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * Main "Hello World" Admin View
 */
class HtmlView extends BaseHtmlView
{
	protected $state;

	protected $item;

	protected $form;

	/**
	 * Display the view
	 * @throws Exception
	 */
	public function display($tpl = null): void {
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
	 */
	protected function addToolbar(): void {
		Factory::getApplication()->input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		JToolbarHelper::title( Text::_('Committee Member'), 'committeemember.png');

		JToolBarHelper::apply('committeemember.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('committeemember.save', 'JTOOLBAR_SAVE');
		JToolBarHelper::custom(
			'committeemember.save2new',
			'save-new.png',
			'save-new_f2.png',
			'JTOOLBAR_SAVE_AND_NEW',
			false
		);

		// If an existing item, can save to a copy.
		if (!$isNew)
		{
			JToolBarHelper::custom(
				'committeemember.save2copy',
				'save-copy.png',
				'save-copy_f2.png',
				'JTOOLBAR_SAVE_AS_COPY',
				false
			);
		}
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('committeemember.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			JToolBarHelper::cancel('committeemember.cancel', 'JTOOLBAR_CLOSE');
		}
	}

}
