<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$item = $this->item;
?>

<h1><?php echo $item->name ?></h1>

<p>This event is on: <?php echo $item->date;?></p>
<p>You must buy tickets by: <?php echo $item->date_close;?></p>
<p>This event is part of the: <?php echo $item->season;?> season</p>