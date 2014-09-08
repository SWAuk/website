<?php

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_swa/assets/js/form.js');
?>

<!--</style>-->
<script type="text/javascript">
	getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
		jQuery(document).ready(function() {
			jQuery('#form-member').submit(function(event) {
			});
		});
	});
</script>

<h1>Member Tickets</h1>

<table>
	<tr>
		<th>Ticket #</th>
		<th>Date</th>
		<th>Event</th>
		<th>Type</th>
	</tr>

	<?php
	foreach( $this->items as $item ) {
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->date . "</td>\n";
		echo "<td>" . $item->event . "</td>\n";
		echo "<td>" . $item->ticket_type . "</td>\n";
		echo "</tr>\n";
		//array(1) { [0]=> object(stdClass)#151 (5) { ["id"]=> string(1) "1" ["event"]=> string(16) "Bruwe Wet Dreams" ["date"]=> string(10) "2014-09-12" ["ticket_type"]=> string(8) "Host Uni" } }
	}
	?>

</table>