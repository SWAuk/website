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
		<th>Id</th>
		<th>Name</th>
		<th>Paid</th>
		<th>Committee</th>
		<th>Discipline</th>
		<th>Level</th>
		<th>Event Registration</th>
	</tr>

	<?php
	foreach( $this->items as $item ) {
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->name . "</td>\n";
		echo "<td>" . ( $item->paid ? 'Yes' : 'No' ) . "</td>\n";
		echo "<td>" . ( $item->club_committee ? 'Yes' : 'No' ) . "</td>\n";
		echo "<td>" . $item->discipline . "</td>\n";
		echo "<td>" . $item->level . "</td>\n";
		echo "<td><ul>";
		foreach( $this->events as $event ) {
			//TODO provide links to register / unregister
			//TODO give feed back depending on who is already registered / unregistered?
			echo "<li>" . $event->name . "</li>\n";
		}
		echo "</ul></td>\n";
		echo "</tr>\n";
	}
	?>

</table>