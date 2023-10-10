<?php

namespace SwaUK\Component\Swa\Administrator;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;
use JText;
use SwaUK\Component\Swa\Administrator\Controller\SwaController;

defined( '_JEXEC' ) or die;

// Access check.
$app = Factory::getApplication();
if ( !$app->getIdentity()->authorise( 'core.manage', 'com_swa' ) )
{
	throw new Exception( JText::_( 'JERROR_ALERTNOAUTHOR' ) );
}
Log::add( 'Failed to Get application in swa.php', Log::ERROR );
}

// Include dependencies
jimport( 'joomla.application.component.controller' );

Log::addLogger(
	array(
		// Sets file name
		'text_file'         => 'com_swa.audit_backend.' . Factory::getDate()->format( 'Y-m-d' ) . '.php',
		// Sets the format of each line
		'text_entry_format' => '{TIME} {CLIENTIP} {PRIORITY} {MESSAGE}',
	),
	// Sets all but DEBUG log level messages to be sent to the file
	Log::ALL,
	// The log category which should be recorded in this file
	array( 'com_swa.audit_backend' )
);

$controller = BaseController::getInstance( 'Swa' );
$controller->execute( $app->input->get( 'task' ) );
$controller->redirect();
