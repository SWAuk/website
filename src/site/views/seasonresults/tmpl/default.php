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
echo "<th>\n";
echo "<td><strong>Uni</strong></td>\n";
echo "<td><strong>Team</strong></td>\n";
echo "<td><strong>Points</strong></td>\n";
echo "<td>Competitions</td>\n";
echo "<td>Discarded</td>\n";
echo "</th>\n";

$positionCounter = 0;
foreach ( $this->teamItems['results'] as $teamDetails ) {
	$positionCounter++;
	// Name is technically use input so strip it just in case..
	$name = strip_tags( $teamDetails['name'] );
	echo "<tr>\n";
	echo "<td>{$positionCounter}</td>\n";
	echo "<td>{$name}</td>\n";
	echo "<td>{$teamDetails['team']}</td>\n";
	echo "<td>{$teamDetails['result']}</td>\n";
	echo "<td>{$teamDetails['competitions']}</td>\n";
	echo "<td>{$teamDetails['discard_points']}</td>\n";
	echo "</tr>\n";
}

echo "</table>\n";

foreach( $this->individualItems as $seriesName => $seriesDetails ) {

	echo "<h2>" . ucfirst( $seriesName ) . " Series</h2>\n";
	echo "<p>Competitions: {$seriesDetails['competitions']}, DNC score: {$seriesDetails['dnc_score']}</p>";
	echo "<table border=\"1\">\n";
	echo "<th>\n";
	echo "<td><strong>Name</strong></td>\n";
	echo "<td><strong>Points</strong></td>\n";
	if( $seriesName == 'race' ) {
		echo "<td>Level</td>\n";
	}
	echo "<td>Competitions</td>\n";
	echo "<td>Discarded</td>\n";
	echo "</th>\n";

	$positionCounter = 0;
	foreach ( $seriesDetails['results'] as $resultDetails ) {
		$positionCounter++;
		// Name is technically use input so strip it just in case..
		$name = strip_tags( $resultDetails['name'] );
		echo "<tr>\n";
		echo "<td>{$positionCounter}</td>\n";
		echo "<td>{$name}</td>\n";
		echo "<td>{$resultDetails['result']}</td>\n";
		if( $seriesName == 'race' ) {
			$resultDetails['comp_type'] = str_replace( ' race', '', $resultDetails['comp_type'] );
			echo "<td>{$resultDetails['comp_type']}</td>\n";
		}
		echo "<td>{$resultDetails['competitions']}</td>\n";
		echo "<td>{$resultDetails['discard_points']}</td>\n";
		echo "</tr>\n";
	}


	echo "</table>\n";

}
