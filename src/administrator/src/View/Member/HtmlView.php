<?php
namespace SwaUK\Component\Swa\Administrator\View\Member;

use SwaUK\Component\Swa\Administrator\View\SwaHtmlViewSingle;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to edit
 */
class HtmlView extends SwaHtmlViewSingle {
	protected $tableName = 'member';
	protected $titleName = 'Member';
}
