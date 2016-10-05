<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );

?>

<!--</style>-->
<script type="text/javascript">
	getScript( '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
		jQuery( document ).ready( function () {
			jQuery( '#form-member' ).submit( function ( event ) {
			} );
		} );
	} );
</script>

<h1>University Members (pending)</h1>

<p>View:
	<?php
	foreach( $this->layouts as $layout => $text ) {
		$href = JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=' . $layout );
		echo "<a href='$href' title='$text'>" . ucfirst( $layout ) . "</a>\n";
	}
	?>
</p>

<p>
	Here you can see all current registered members of your university that you are yet to approve
	(i.e. freshers)
</p>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Paid</th>
			<th>Discipline</th>
			<th>Level</th>
			<th>Course</th>
			<th>Approve</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( $this->items as $item ) {
			if ( $item->confirmed_university ) {
				continue;
			}
			echo "<tr>\n";
			echo "<td>" . $item->id . "</td>\n";
			echo "<td>" . $item->name . "</td>\n";
			if ( $item->paid ) {
				echo "<td bgcolor='#CCFF33'>Yes</td>\n";
			} else {
				echo "<td bgcolor='#FF6666'>No</td>\n";
			}
			echo "<td>" . $item->discipline . "</td>\n";
			echo "<td>" . $item->level . "</td>\n";
			echo "<td>" . $item->course . "</td>\n";
			echo '<td><form id="form-universitymembers-approve-' .
				$item->id .
				'" method="POST" action="' .
				JRoute::_( 'index.php?option=com_swa&task=universitymembers.approve' ) .
				'">' .
				'<input type="hidden" name ="member_id" value="' .
				$item->id .
				'" />' .
				'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-approve-' .
				$item->id .
				'\').submit(); return false;">(approve)</a>' .
				JHtml::_( 'form.token' ) .
				'</form></td>';
			echo "</tr>\n";
		}
		?>
	</tbody>
</table>