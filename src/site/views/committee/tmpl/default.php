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

<h1>Committee</h1>

<table>
	<tr>
		<th>Name</th>
		<th>Position</th>
		<th>Blurb</th>
		<th>Image</th>
	</tr>

	<?php
	foreach ( $this->items as $item ) {
		echo "<tr>\n";
		echo "<td>" . $item->name . "</td>\n";
		echo "<td>" . $item->position . "</td>\n";
		echo "<td>" . $item->blurb . "</td>\n";
		echo "<td><img width=\"200\" src=\"" . $item->image . "\"/></td>\n";
		echo "</tr>\n";
	}
	?>

</table>