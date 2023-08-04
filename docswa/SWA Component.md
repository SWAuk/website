Components in Joomla, are like modules. We have our own module for everything we need. It is called `com_swa`

The result of this component, will be found at either `/public_html/components/com_swa` or `/public_html/administrator/components/com_swa` depending on its usage. Administrator means it relates to the [[admin panel]]

The structure of `com_swa` is as follows.
#todo
.
|-- ModelForm.php
|-- ModelItem.php
|-- ModelList.php
|-- SwaFactory.php
|-- SwaModelMemberTrait.php
|-- assets
|   |-- css
|   |-- images
|   |   -- 404.svg
|   |-- js
|   |   -- form.js
|   |-- resources
|       -- swaterms.pdf
|-- controller.php
|-- controllers
|   -- ticketpurchase.php
|   -- universitymembers.php
|-- helpers
|   -- index.html
|   -- swa.php
|-- index.html
|-- language
|-- libraries
|   |-- stripe
|-- models
|   |-- clubupdate.php
|   |-- forms
|   |   -- clubupdate.xml
|   -- index.html
|   -- universities.php
|   -- university.php
|-- node_modules
-- package-lock.json
-- package.json
-- router.php
-- swa.php
|-- views
    |-- universities
    |   -- index.html
    |   |-- tmpl
    |   |   -- default.php
    |   |   -- default.xml
    |   |   -- index.html
    |   -- view.html.php
    |-- university
    |   -- index.html
    |   |-- tmpl
    |   |   -- default.php
    |   |   -- default.xml
    |   |   -- index.html
    |   -- view.html.php
    |-- ticketpurchase