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

$eventsBySeason = array();

foreach ( $this->items as $item ) {
    $eventsBySeason[$item->season_year][] = $item;
}
?>

<div class="lead"><h1>Events</h1></div>
<?php
foreach ( $eventsBySeason as $seasonYear => $events ) {
    $seasonYearId = str_replace('/', '-', $seasonYear);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <div><?php echo $seasonYear . " Season"; ?></div>
        </h3>
    </div>
    <div id="collapse<?php echo $seasonYearId; ?>" class="panel-collapse collapse in">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th width="30%">Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event) {
                    $eventUrl = JRoute::_('index.php?option=com_swa&view=event&event=' . $event->id);
                    echo "<tr>\n";
                    echo "<td><a href='$eventUrl'>" . $event->name . "</a></td>\n";
                    echo "<td>" . $event->date . "</td>\n";
                    echo "</tr>\n";
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>
