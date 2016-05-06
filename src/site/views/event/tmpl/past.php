<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$item = $this->item;
?>

<h1><?php echo $item->name ?></h1>

<p>This event was on: <?php echo $item->date;?></p>
<p>This event is part of the: <?php echo $item->season;?> season</p>

<?php

$indiResults = $this->get( 'IndiResults' );
$teamResults = $this->get( 'TeamResults' );

if( $teamResults ) {
    echo "<h2>Team Results</h2>\n";
    echo "<table border=\"1\">\n";
    echo "<th><td><strong>Uni</strong></td><td><strong>Team</strong></td><td><strong>Points</strong></td></th>\n";

    $positionCounter = 0;
    foreach( $teamResults as $result ) {
        $positionCounter++;
        echo "<tr><td>{$positionCounter}</td><td>{$result['name']}</td><td>{$result['team_number']}</td><td>{$result['result']}</td></tr>\n";
    }

    echo "</table>\n";
}

foreach( $indiResults as $compName => $results ) {
    echo "<h2>{$compName} Results</h2>\n";
    echo "<table border=\"1\">\n";
    echo "<th><td><strong>Name</strong></td><td><strong>University</strong></td><td><strong>Points</strong></td></th>\n";

    $positionCounter = 0;
    foreach( $results as $result ) {
        $positionCounter++;
        $name = strip_tags( $result['name'] );
        $uni = strip_tags( $result['university'] );
        echo "<tr><td>{$positionCounter}</td><td>{$name}</td><td>{$uni}</td><td>{$result['result']}</td></tr>\n";
    }

    echo "</table>\n";
}