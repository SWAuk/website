<?php
namespace SwaUK\Component\Swa\Administrator\View\Members;
use Joomla\CMS\Language\Text;
use SwaUK\Component\Swa\Administrator\View\SwaHtmlView;

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Swa.
 */
class HtmlView extends SwaHtmlView {
	protected $titleName = 'Members';
	protected $tableName = 'members';
	protected function getSortFields(): array {
		return array(
			'id'              => Text::_('JGRID_HEADING_ID'),
			'user'            => Text::_('User'),
			'university'      => Text::_('University'),
			'lifetime_member' => Text::_('Lifetime Member'),
		);
	}
}
