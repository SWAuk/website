<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

class SwaViewSeasonResults extends JViewLegacy {

	protected $state;
	protected $params;

	protected $individualItems;
	protected $teamItems;

	public function display( $tpl = null ) {
		$app = JFactory::getApplication();

		$this->state = $this->get( 'State' );
		$this->params = $app->getParams( 'com_swa' );

		// Check for errors.
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			throw new Exception( implode( "\n", $errors ) );
		}

		$this->individualItems = $this->get( 'IndividualItems' );
		$this->teamItems = $this->get( 'TeamItems' );

		parent::display( $tpl );
	}

}
