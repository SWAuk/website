===========
Contents
===========

* Installing Joomla Template
* Utilizing Menus
* Customizing the Footer

For more information please visit http://www.artisteer.com/?p=help_joomla

*** Installing Joomla Template
---------------------------------------

To install an exported and zipped template via the Joomla administration panel please do the following:
1. Go to Joomla Administrator (www.your-site.com/administrator) -> Extensions -> Install/Uninstall
2. In the "Extension Manager" choose the first option 'Upload Package File'.
3. Click the "Browse..." button to select the zip file from your computer.
4. Click the "Upload File & Install" button.

For more information please visit http://docs.joomla.org/How_to_install_templates

*** Utilizing Menus
-------------------------------
Please use the following steps to utilize menu style designed with Artisteer:
1. Go to Joomla Administrator (www.your-site.com/administrator) -> Extensions -> Module Manager.
2. Open an existing menu or create a new one and place it into the "position-1" position.

NOTE: the "position-1" position can contain only a single menu, or none.

To create a custom Vertical Menu with separators:

   1. Log in to Joomla Administration and open your custom menu (Menus-> [custom menu name])
   2. Press "New" to add a menu item and select a separator menu item type, or click the existing menu item, press "Change Type" and save it as a separator. 
   3. Open the item, which is to be placed inside the separator, and select the separator as its parent item. 
*** Customizing the Footer
------------------------------
To customize the template footer in Joomla administration place one or multiple modules into
the "copyright" position. This will replace the default copyright text included in the template
footer with the new content provided by the module.

Here are sample steps to configure custom footer:
1. Go to Joomla Administrator (www.your-site.com/administrator) -> Extensions -> Module Manager.
2. Click "New", select "Custom HTML", then select "Next".
3. In the module properties specify:
    Title - Show Title: No
    Position: copyright
    Custom Output: (the desired footer content)
4. Save your changes.

You can now use the newly created module for further footer customizations without utilizing additional modules.

