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

<h1>Season results</h1>

<p>Below are the results for the current season so far.</p>

<?php

foreach( $this->items as $seriesName => $seriesDetails ) {

	echo "<h3>" . ucfirst( $seriesName ) . " Series</h3>\n";
	echo "<p>Competitions: {$seriesDetails['competitions']}, DNC score: {$seriesDetails['dnc_score']}</p>";
	echo "<table border=\"1\">\n";
	echo "<th><td>Name</td><td>Points</td></th>\n";

	$positionCounter = 0;
	foreach ( $seriesDetails['results'] as $resultDetails ) {
		$positionCounter++;
		echo "<tr><td>{$positionCounter}</td><td>{$resultDetails['name']}</td><td>{$resultDetails['result']}</td></tr>";
	}


	echo "</table>\n";

}
