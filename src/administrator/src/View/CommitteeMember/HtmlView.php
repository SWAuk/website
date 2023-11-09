<?php

namespace SwaUK\Component\Swa\Administrator\View\CommitteeMember;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use RuntimeException;
use SwaUK\Component\Swa\Administrator\View\SwaHtmlViewSingle;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 *
 * @copyright   Copyright (C) 2020 John Smith. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */
class HtmlView extends SwaHtmlViewSingle {
	protected $tableName = 'committeemember';
	protected $titleName = 'Committee Member';
}

