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
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;use RuntimeException;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * View to edit
 */
abstract class SwaHtmlViewSingle extends BaseHtmlView {
	protected $state;

	protected $item;

	protected $form;
	protected $tableName = '';
	protected $titleName = '';

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$this->state = $this->get( 'State' );
		$this->item  = $this->get( 'Item' );
		$this->form  = $this->get( 'Form' );

		// Check for errors.
		if ( ! empty( $errors = $this->get( 'Errors' ) ) )
		{
			throw new RuntimeException( implode( "\n", $errors ), 500 );
		}

		$this->addToolbar();
		parent::display( $tpl );
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar() {
		Factory::getApplication()->input->set( 'hidemainmenu', true );

		$isNew = ( $this->item->id == 0 );

		ToolbarHelper::title( Text::_( $this->titleName ), $this->tableName . '.png' );
		ToolbarHelper::apply( $this->tableName . '.apply' );
		ToolbarHelper::save( $this->tableName . '.save' );
		ToolbarHelper::save2new( $this->tableName . '.save2new' );

		// If an existing item, can save to a copy.
		if ( ! $isNew )
		{
			ToolbarHelper::save2copy( $this->tableName . '.save2copy' );
		}
		if ( empty( $this->item->id ) )
		{
			ToolbarHelper::cancel( $this->tableName . '.cancel' );
		}
		else
		{
			ToolbarHelper::cancel( $this->tableName . '.cancel', 'JTOOLBAR_CLOSE' );
		}
	}

}
