<?php
// no direct access
defined('_JEXEC') or die;

/**
 * This code needs to be loaded and run in the JAccess::getAuthorisedViewLevels method before the final return.
 */

// To avoid recursion we must only load the 'swa' plugin once here.
// This is needed as this code can be run multiple times in a request, but we only want to load the plugin the first time.
if (!array_key_exists('SWA_PLUGIN_IS_IMPORTED', $GLOBALS)) {
	$GLOBALS['SWA_PLUGIN_IS_IMPORTED'] = true;
	\Joomla\CMS\Plugin\PluginHelper::importPlugin('swa');
}

// Trigger the custom event, which will run our custom code
\JEventDispatcher::getInstance()->trigger(
	'onJAccessGetAuthorisedViewLevels',
	array( $userId, &$authorised )
);
