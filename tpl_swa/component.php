<?php
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html dir="ltr" lang="<?php echo $document->language; ?>">
<head>
 <jdoc:include type="head" />
 <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/css/print.css" type="text/css" />
</head>
<body class="contentpane">
 <jdoc:include type="message" />
 <jdoc:include type="component" />
</body>
</html>
