<?php

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

<h1>Universities</h1>

<p>Below is a list of universities registered with the SWA.</p>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Url</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( $this->items as $item ) {
			echo "<tr>\n";
			echo "<td>" . $item->name . "</td>\n";
			if ( empty( $item->url ) ) {
				echo "<td></td>";
			} else {
				echo "<td><a href=\"" . $item->url . "\">" . $item->url . "</a></td>\n";
			}
			echo "</tr>\n";
		}
		?>
	</tbody>
</table>