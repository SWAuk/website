## Production

* Create zip files for the component and plugin using `composer build`.
* Go to the Joomla backend, http://localhost:5555/administrator
* Log in (admin:password)
* Top menu, Extensions >> Manage >> Install
* Select "Upload package from file"
* Upload the com_swa.zip file that was created in the root repo folder
* Upload the plg_swa_viewlevels.zip file that was created in the root repo folder **MAY BE REDUNDANT**
* Enable the plugin in the Extensions >> Plugins page **MAY BE REDUNDANT**
* Add the custom event to Joomla code ([[onJAccessGetAuthorisedViewLevels custom event]]) **MAY BE REDUNDANT**

