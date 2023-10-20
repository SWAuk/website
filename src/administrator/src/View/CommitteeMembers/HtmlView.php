<?php

namespace SwaUK\Component\Swa\Administrator\View\CommitteeMembers;

use Exception;
use JHtmlSidebar;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use JToolbarHelper;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

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
class HtmlView extends BaseHtmlView {
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$this->state      = $this->get( 'State' );
		$this->items      = $this->get( 'Items' );
		$this->pagination = $this->get( 'Pagination' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) )
		{
			throw new GenericDataException( implode( "\n", $errors ), 500 );
		}


//		require_once JPATH_COMPONENT . '/helpers/swa.php';
//		SwaHelper::addSubmenu('committeemembers');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display( $tpl );
	}

	/**
	 * Add the page title and toolbar.
	 *
	 */
	protected function addToolbar(): void {
		// Get the toolbar object instance
		$toolbar = Toolbar::getInstance( 'toolbar' );
		ToolbarHelper::title( Text::_( 'COM_SWA_COMMITTEE_MEMBERS_PAGE_TITLE' ), 'committeemembers.png' );

		$canDo = ContentHelper::getActions( 'com_swa' );
		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/committeemember';

		if ( $canDo->get( 'core.create' ) && file_exists( $formPath ) )
		{
			$toolbar->addNew( 'committeemember.add' );

			if ( isset( $this->items[0] ) )
			{
				$toolbar->addNew( 'committeemember.edit', 'JTOOLBAR_EDIT' );
			}
			$toolbar->addNew( 'committeemembers.delete', 'JTOOLBAR_DELETE' );
		}

		if ($canDo->get('core.admin'))
		{
			$toolbar->preferences('com_swa');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction( 'index.php?option=com_swa&view=committeemembers' );

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
