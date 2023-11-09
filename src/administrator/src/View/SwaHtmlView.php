<?php
/**
 * @package     SwaUK\Component\Swa\Administrator\View
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace SwaUK\Component\Swa\Administrator\View;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarFactoryInterface;
use Joomla\CMS\Toolbar\ToolbarHelper;use RuntimeException;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to edit
 */
abstract class SwaHtmlView extends HtmlView {
	protected $state;

	protected $item;

	protected $form;
	protected $tableName = '';
	protected $titleName = '';

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
		ToolbarHelper::title( Text::_( $this->titleName ), $this->tableName . '.png' );
		$canDo = ContentHelper::getActions( 'com_swa' );
		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/' . $this->tableName;

		if ( isset( $this->items[0] ) )
		{
			ToolbarHelper::editList($this->tableName . ".edit");
		}
		ToolbarHelper::deleteList($this->tableName . ".delete");

		if ($canDo->get('core.admin'))
		{
			$toolbar->preferences('com_swa');
		}

		// Set sidebar action - New in 3.0
		Sidebar::setAction( 'index.php?option=com_swa&view='.$this->tableName );

		$this->extra_sidebar = '';

	}

	abstract protected function getSortFields(): array;
}
