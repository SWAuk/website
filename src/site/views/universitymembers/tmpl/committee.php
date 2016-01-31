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

<h1>University Members (committee)</h1>

<p>View:
	<?php
	foreach( $this->layouts as $layout => $text ) {
		$href = JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=' . $layout );
		echo "<a href='$href' title='$text'>" . ucfirst( $layout ) . "</a>\n";
	}
	?>
</p>

<p>
	Here you can see all current registered members of your university that are marked as being on your committee.
</p>

<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Position</th>
		<th>Demote</th>
	</tr>

	<?php
	foreach ( $this->items as $item ) {
		if ( !$item->club_committee ) {
			continue;
		}
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->name . "</td>\n";
		echo "<td>" . $item->club_committee . "</td>\n";
		echo '<td><form id="form-universitymembers-removecommittee-' .
			$item->id .
			'" method="POST" action="' .
			JRoute::_( 'index.php?option=com_swa&task=universitymembers.removecommittee' ) .
			'">' .
			'<input type="hidden" name ="member_id" value="' .
			$item->id .
			'" />' .
			'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-removecommittee-' .
			$item->id .
			'\').submit(); return false;">(demote)</a>' .
			JHtml::_( 'form.token' ) .
			'</form></td>';
		echo "</tr>\n";
		echo "</tr>\n";
	}
	?>

</table>

<p>
	Here you can promote people to your committee!
	Doing so given them extra access to the SWA website!
</p>

<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Promote</th>
	</tr>

	<?php
	foreach ( $this->items as $item ) {
		if ( $item->club_committee ) {
			continue;
		}
		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->name . "</td>\n";
		echo '<td><form id="form-universitymembers-addcommittee-' .
			$item->id .
			'" method="POST" action="' .
			JRoute::_( 'index.php?option=com_swa&task=universitymembers.addcommittee' ) .
			'">' .
			'<input type="hidden" name ="member_id" value="' .
			$item->id .
			'" />' .
			'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-addcommittee-' .
			$item->id .
			'\').submit(); return false;">(add to committee)</a>' .
			JHtml::_( 'form.token' ) .
			'</form></td>';
		echo "</tr>\n";
	}
	?>

</table>