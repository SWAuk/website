Joomla SWA AccessList plugin
==================

This plugin uses a custom event **onJAccessGetAuthorisedViewLevels**.

This plugin works along side com_swa to add access levels to users based on decisions made by the component.

#### Adding the event

The event must be added to the **JAccess::getAuthorisedViewLevels**.

The JAccess class can be found in libraries\src\Access\Access.php

You can find the method in the file by searching for "getAuthorisedViewLevels"

To avoid recursion we must only load the 'swa' plugins Once here.

Add the following code just before the final return of the method:

```
// Hack for plg_swa_viewlevels per https://github.com/SWAuk/plg_swa_viewlevels
static $importedSwaPlugins;
if( !$importedSwaPlugins ) {
	$importedSwaPlugins = true;
	\Joomla\CMS\Plugin\PluginHelper::importPlugin( 'swa' );
}
\JEventDispatcher::getInstance()->trigger(
	'onJAccessGetAuthorisedViewLevels',
	array( $userId, &$authorised )
);
// Hack end!
```
