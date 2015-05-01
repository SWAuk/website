<?php

// No direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

class SwaViewCommittee extends JViewLegacy {

	protected $state;
	protected $items;
	protected $params;

	/**
	 * Display the view
	 */
	public function display( $tpl = null ) {
		$app = JFactory::getApplication();

		$this->state = $this->get( 'State' );
		$this->params = $app->getParams( 'com_swa' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		$this->items = $this->get( 'Items' );

		parent::display( $tpl );
	}

}
