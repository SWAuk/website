<?php

// no direct access
defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$doc = JFactory::getDocument();
$doc->addScript( JUri::base() . '/components/com_swa/assets/js/form.js' );
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

<h1>Qualifications</h1>

<?php
if( empty( $this->items ) ) {
	echo "<p>You do not have any qualifications registered with us!</p>";
} else {
	?>

	<table>
		<tr>
			<th>Id</th>
			<th>Type</th>
			<th>Expiry</th>
		</tr>

		<?php
		foreach ( $this->items as $item ) {
			echo "<tr>\n";
			echo "<td>" . $item->id . "</td>\n";
			echo "<td>" . $item->type . "</td>\n";
			if ( new DateTime( $item->expiry ) < new DateTime() ) {
				echo "<td bgcolor='#FF6666'>";
			} else {
				echo "<td>";
			}
			echo $item->expiry;
			echo "</td>";
			echo "</tr>\n";
		}
		?>

	</table>

	<?php
}
?>

<h2>Add new qualification</h2>

<p>Not yet implemented!</p>