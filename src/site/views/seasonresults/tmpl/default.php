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

echo "<h2>Team Series</h2>\n";
echo "<p>Competitions: {$this->teamItems['competitions']}, DNC score: {$this->teamItems['dnc_score']}</p>";
echo "<table border=\"1\">\n";
echo "<th><td><strong>Uni</strong></td><td><strong>Team</strong></td><td><strong>Points</strong></td></th>\n";

$positionCounter = 0;
foreach ( $this->teamItems['results'] as $uniName => $teams ) {
	foreach( $teams as $teamNumber => $teamDetails ) {
		$positionCounter++;
		// Name is technically use input so strip it just in case..
		$name = strip_tags( $teamDetails['name'] );
		echo "<tr><td>{$positionCounter}</td><td>{$name}</td><td>{$teamDetails['team']}</td><td>{$teamDetails['result']}</td></tr>";
	}
}

echo "</table>\n";

foreach( $this->individualItems as $seriesName => $seriesDetails ) {

	echo "<h2>" . ucfirst( $seriesName ) . " Series</h2>\n";
	echo "<p>Competitions: {$seriesDetails['competitions']}, DNC score: {$seriesDetails['dnc_score']}</p>";
	echo "<table border=\"1\">\n";
	echo "<th><td><strong>Name</strong></td><td><strong>Points</strong></td></th>\n";

	$positionCounter = 0;
	foreach ( $seriesDetails['results'] as $resultDetails ) {
		$positionCounter++;
		// Name is technically use input so strip it just in case..
		$name = strip_tags( $resultDetails['name'] );
		echo "<tr><td>{$positionCounter}</td><td>{$name}</td><td>{$resultDetails['result']}</td></tr>";
	}


	echo "</table>\n";

}
