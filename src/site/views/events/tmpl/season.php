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

/**
 * @return int The current season start year
 */
function getCurrentSeasonYear() {
	$currentYear = intval( date( "Y" ) );
	$currentMonth = intval( date( "n" ) );//1-12
	// 1 July onwards counts as the new season
	if ( $currentMonth <= 06 ) {
		return $currentYear - 1;
	}

	return $currentYear;
}
$currentSeasonYear = getCurrentSeasonYear();
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

<h1>Season Events</h1>

<p>Events listed below are in the current season.</p>

<table>
	<tr>
		<th>Name</th>
		<th>Date</th>
	</tr>

	<?php
	foreach ( $this->items as $item ) {
		//Skip events that dont have this seaosn year!
		if( $item->season_year != $currentSeasonYear ) {
			continue;
		}
		echo "<tr>\n";
		echo "<td><a href=''>" . $item->name . "</a></td>\n";
		echo "<td>" . $item->date . "</td>\n";
		echo "</tr>\n";
	}
	?>

</table>