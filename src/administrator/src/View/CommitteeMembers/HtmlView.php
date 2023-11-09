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
use SwaUK\Component\Swa\Administrator\View\SwaHtmlView;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 *
 * @copyright   Copyright (C) 2020 John Smith. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */
class HtmlView extends SwaHtmlView {
	protected $titleName = 'COM_SWA_TITLE_COMMITTEE';
	protected $tableName = 'committeemembers';

	protected function getSortFields(): array {
		return array(
			'ordering' => Text::_( 'Order' ),
			'id'       => Text::_( 'JGRID_HEADING_ID' ),
			'member'   => Text::_( 'Member' ),
			'position' => Text::_( 'Position' ),
		);
	}

}
