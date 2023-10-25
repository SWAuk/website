<?php

namespace SwaUK\Component\Swa\Administrator\View\CommitteeMembers;

use JHtmlSidebar;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarFactoryInterface;
use Joomla\CMS\Toolbar\ToolbarHelper;
use RuntimeException;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 *
 * @copyright   Copyright (C) 2020 John Smith. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

class HtmlView extends BaseHtmlView {
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 */
	function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (!empty($errors = $this->get('Errors')))
		{
			throw new RuntimeException(implode("\n", $errors), 500);
		}

		// Include the helper and add submenu
//		require_once JPATH_COMPONENT . '/helpers/swa.php';
//		\SwaHelper::addSubmenu('committeemembers');

		// Load the toolbar and sidebar
		$this->addToolbar();
		$this->sidebar = Sidebar::render();

		// Render the view
		parent::display($tpl);
	}


	/**
	 * Add the page title and toolbar.
	 *
	 */
	protected function addToolbar(): void {
		// Get the toolbar object instance
		$toolbar = Factory::getContainer()->get(ToolbarFactoryInterface::class)->createToolbar('toolbar');
		ToolbarHelper::title( Text::_( 'COM_SWA_TITLE_COMMITTEE' ), 'committeemembers.png' );
		$canDo = ContentHelper::getActions( 'com_swa' );
		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/committeemember';

		if ( isset( $this->items[0] ) )
		{
			ToolbarHelper::editList("committeemember.edit");
		}
		ToolbarHelper::deleteList("committeemember.delete");

		if ($canDo->get('core.admin'))
		{
			$toolbar->preferences('com_swa');
		}

		// Set sidebar action - New in 3.0
		Sidebar::setAction( 'index.php?option=com_swa&view=committeemembers' );

		$this->extra_sidebar = '';

	}

	protected function getSortFields() {
		return array(
			'ordering' => Text::_( 'Order' ),
			'id'       => Text::_( 'JGRID_HEADING_ID' ),
			'member'   => Text::_( 'Member' ),
			'position' => Text::_( 'Position' ),
		);
	}

}
