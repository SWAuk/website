<?php
defined( '_JEXEC' ) or die;

// Access check.
if ( !JFactory::getUser()->authorise( 'core.manage', 'com_swa' ) ) {
	throw new Exception( JText::_( 'JERROR_ALERTNOAUTHOR' ) );
}

// Include dependencies
jimport( 'joomla.application.component.controller' );

JLog::addLogger(
	array(
		// Sets file name
		'text_file' => 'com_swa.audit_backend.' . JFactory::getDate()->format( 'Y-m-d' ) . '.php',
		// Sets the format of each line
		'text_entry_format' => '{TIME} {CLIENTIP} {PRIORITY} {MESSAGE}',
	),
	// Sets all but DEBUG log level messages to be sent to the file
	JLog::ALL,
	// The log category which should be recorded in this file
	array( 'com_swa.audit_backend' )
);

// Include other stuff
require_once( __DIR__ . '/ControllerForm.php' );
require_once( __DIR__ . '/ControllerAdmin.php' );

$controller = JControllerLegacy::getInstance( 'Swa' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();
