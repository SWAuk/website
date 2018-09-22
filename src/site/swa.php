<?php
defined( '_JEXEC' ) or die;

// Include dependencies
jimport( 'joomla.application.component.controller' );

JLog::addLogger(
	array(
		// Sets file name
		'text_file' => 'com_swa.all.' . JFactory::getDate()->format( 'Y-m-d' ) . '.php',
		// Sets the format of each line
		'text_entry_format' => '{TIME} {CLIENTIP} {PRIORITY} {MESSAGE}',
	),
	// Sets all but DEBUG log level messages to be sent to the file
	JLog::ALL,
	// The log category which should be recorded in this file
	array( 'com_swa' )
);

JLog::addLogger(
	array(
		// Sets file name
		'text_file' => 'com_swa.payment_process.' .
			JFactory::getDate()->format( 'Y-m-d' ) .
			'.php',
		// Sets the format of each line
		'text_entry_format' => '{TIME} {CLIENTIP} {PRIORITY} {MESSAGE}',
	),
	// Sets all but DEBUG log level messages to be sent to the file
	JLog::ALL,
	// The log category which should be recorded in this file
	array( 'com_swa.payment_process' )
);

JLog::addLogger(
	array(
		// Sets file name
		'text_file' => 'com_swa.audit_frontend.' . JFactory::getDate()->format( 'Y-m-d' ) . '.php',
		// Sets the format of each line
		'text_entry_format' => '{TIME} {CLIENTIP} {PRIORITY} {MESSAGE}',
	),
	// Sets all but DEBUG log level messages to be sent to the file
	JLog::ALL,
	// The log category which should be recorded in this file
	array( 'com_swa.audit_frontend' )
);

// Inclue other stuff
require_once( __DIR__ . '/SwaFactory.php' );
require_once( __DIR__ . '/ModelItem.php' );
require_once( __DIR__ . '/ModelList.php' );
require_once( __DIR__ . '/ModelForm.php' );

// Setup Stripe
require_once JPATH_LIBRARIES . '/stripe/init.php';
$jconfig  = JFactory::getConfig();
\Stripe\Stripe::setApiKey($jconfig->get('stripe_secret_key'));
\Stripe\Stripe::setApiVersion("2017-05-25");

// Execute the task.
$controller = JControllerLegacy::getInstance( 'Swa' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();
