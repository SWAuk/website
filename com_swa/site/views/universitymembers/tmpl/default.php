<?php

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
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

<h1>University Members</h1>

<table>
	<tr>
		<th>Member id</th>
		<th>Paid</th>
		<th>Confirmed</th>
		<th>Committee</th>
		<th>Discipline</th>
		<th>Level</th>
	</tr>

	<?php
	foreach( $this->items as $item ) {
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->paid . "</td>\n";
		echo "<td>" . $item->club_committee . "</td>\n";
		echo "<td>" . $item->discipline . "</td>\n";
		echo "<td>" . $item->level . "</td>\n";
		echo "</tr>\n";
	}
	?>

</table>