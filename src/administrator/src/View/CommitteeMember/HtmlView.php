<?php

namespace SwaUK\Component\Swa\Administrator\View\CommitteeMember;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
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
	protected $state;

	protected $item;

	protected $form;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$this->state = $this->get( 'State' );
		$this->item  = $this->get( 'Item' );
		$this->form  = $this->get( 'Form' );

		// Check for errors.
		if (!empty($errors = $this->get('Errors')))
		{
			throw new RuntimeException(implode("\n", $errors), 500);
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

		ToolbarHelper::title( Text::_( 'Committee Member' ), 'committeemember.png' );

		ToolbarHelper::apply( 'committeemember.apply', 'JTOOLBAR_APPLY' );
		ToolbarHelper::save( 'committeemember.save', 'JTOOLBAR_SAVE' );
		ToolbarHelper::custom(
			'committeemember.save2new',
			'save-new.png',
			'save-new_f2.png',
			'JTOOLBAR_SAVE_AND_NEW',
			false
		);

		// If an existing item, can save to a copy.
		if ( ! $isNew )
		{
			ToolbarHelper::custom(
				'committeemember.save2copy',
				'save-copy.png',
				'save-copy_f2.png',
				'JTOOLBAR_SAVE_AS_COPY',
				false
			);
		}
		if ( empty( $this->item->id ) )
		{
			ToolbarHelper::cancel( 'committeemember.cancel', 'JTOOLBAR_CANCEL' );
		}
		else
		{
			ToolbarHelper::cancel( 'committeemember.cancel', 'JTOOLBAR_CLOSE' );
		}
	}

}

