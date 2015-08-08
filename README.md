Joomla SWA AccessList plugin
==================

This plugin uses a custom event **onJAccessGetAuthorisedViewLevels**.

This plugin works along side com_swa to add access levels to users based on decisions made by the component.

#### Adding the event

The event must be added to the **JAccess::getAuthorisedViewLevels**.

To avoid recursion we must only load the 'swa' plugins Once here.

Add the following code just before the return of the method:

		static $importedSwaPlugins;
		if( !$importedSwaPlugins ) {
			$importedSwaPlugins = true;
			JPluginHelper::importPlugin( 'swa' );
		}
		JEventDispatcher::getInstance()->trigger(
			'onJAccessGetAuthorisedViewLevels',
			array( $userId, &$authorised )
		);