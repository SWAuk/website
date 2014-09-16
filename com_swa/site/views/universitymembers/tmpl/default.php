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
		$item->registered_event_ids = explode( ',', $item->registered_event_ids );
		foreach( $this->events as $event ) {
			echo "<li>" . $event->name . ' ';
			if( in_array( $event->id, $item->registered_event_ids ) ) {
				//registered for the event
				echo '<form id="form-universitymembers-unregister" method="POST" action="' . JRoute::_( 'index.php?option=com_swa&task=universitymembers.unregister' ) . '">' .
					'<input type="hidden" name ="member_id" value="' . $item->id . '" />' .
					'<input type="hidden" name ="event_id" value="' . $event->id . '" />' .
					'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-unregister\').submit(); return false;">(unregister)</a>' .
					'</form>';
			} else {
				//not registered for the event
				echo '<form id="form-universitymembers-register" method="POST" action="' . JRoute::_( 'index.php?option=com_swa&task=universitymembers.register' ) . '">' .
					'<input type="hidden" name ="member_id" value="' . $item->id . '" />' .
					'<input type="hidden" name ="event_id" value="' . $event->id . '" />' .
					'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-register\').submit(); return false;">(register)</a>' .
					'</form>';
			}
			echo "</li>\n";
		}
		echo "</ul></td>\n";
		echo "</tr>\n";
	}
	?>

</table>