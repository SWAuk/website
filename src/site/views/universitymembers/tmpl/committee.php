<?php

// no direct access
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
	foreach( $this->layouts as $layout ) {
		$href = JRoute::_( 'index.php?option=com_swa&view=universitymembers&layout=' . $layout );
		echo "<a href='$href'>" . ucfirst( $layout ) . "</a>\n";
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
		echo "</tr>\n";
	}
	?>

</table>