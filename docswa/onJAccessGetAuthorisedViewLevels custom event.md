### Adding onJAccessGetAuthorisedViewLevels custom event

  

For the plugin to work a custom event must be added to the **JAccess::getAuthorisedViewLevels** method which can be found in `libraries\src\Access\Access.php`.

  

Add the following code just before the final return of the method:

  

```php

// START HACK for plg_swa_viewlevels

require __DIR__ . '/../../../plugins/swa/viewlevels/eventsnippet.php';

// END HACK for plg_swa_viewlevels

```

  