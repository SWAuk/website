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

<h1>University Members - Graduated</h1>

<p>View:
	<a href="<?php echo JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=pending' ) ?>" >Pending</a>
	<a href="<?php echo JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=default' ) ?>" >Current</a>
	<a href="<?php echo JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=graduated' ) ?>" >Graduated</a>
</p>

<p>
	Here you can see all current registered members of your university that have already graduated.
</p>

<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Committee</th>
		<th>Discipline</th>
		<th>Level</th>
		<th>Graduation</th>
		<th>Ungraduate</th>
	</tr>

	<?php
	foreach( $this->items as $item ) {
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->name . "</td>\n";
		echo "<td>" . ( $item->club_committee ? 'Yes' : 'No' ) . "</td>\n";
		echo "<td>" . $item->discipline . "</td>\n";
		echo "<td>" . $item->level . "</td>\n";
		echo "<td>" . $item->graduation . "</td>\n";
		echo '<td><form id="form-universitymembers-ungraduate" method="POST" action="' . JRoute::_( 'index.php?option=com_swa&task=universitymembers.ungraduate' ) . '">' .
			'<input type="hidden" name ="member_id" value="' . $item->id . '" />' .
			'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-ungraduate\').submit(); return false;">(ungraduate)</a>' .
			'</form></td>';
		echo "</tr>\n";
	}
	?>

</table>