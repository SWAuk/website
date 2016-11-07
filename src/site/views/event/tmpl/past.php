<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$item = $this->item;
?>

<h1><?php echo $item->event_name ?></h1>

<p>This event was on: <?php echo $item->event_date;?></p>
<p>This event is part of the: <?php echo $item->season;?> season</p>

<?php

$indiResults = $this->get( 'IndiResults' );
$teamResults = $this->get( 'TeamResults' );

if( $teamResults ) {
?>
    <h2>Team Results</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Uni</th>
                <th>Team</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
<?php
    $positionCounter = 0;
    foreach( $teamResults as $result ) {
        $positionCounter++;
        echo "<tr>\n";
        echo "<td>{$positionCounter}</td>\n";
        echo "<td>{$result['name']}</td>\n";
        echo "<td>{$result['team_number']}</td>\n";
        echo "<td>{$result['result']}</td>\n";
        echo "</tr>\n";
    }

    echo "</tbody>\n";
    echo "</table>\n";
}

foreach( $indiResults as $compName => $results ) {
    echo "<h2>{$compName} Results</h2>\n";
?>
    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>University</th>
            <th>Points</th>
        </thead>
        <tbody>
<?php
    $positionCounter = 0;
    foreach( $results as $result ) {
        $positionCounter++;
        $name = strip_tags( $result['name'] );
        $uni = strip_tags( $result['university'] );
        echo "<tr>\n";
        echo "<td>{$positionCounter}</td>\n";
        echo "<td>{$name}</td>\n";
        echo "<td>{$uni}</td>\n";
        echo "<td>{$result['result']}</td>\n";
        echo "</tr>\n";
    }

    echo "</tbody>\n";
    echo "</table>\n";
}