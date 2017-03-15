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

<!-- TODO do this properly-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.collapse').on('show.bs.collapse', function () {
            jQuery(this).parent().find('.glyphicon-triangle-right')
                .removeClass("glyphicon-triangle-right")
                .addClass("glyphicon-triangle-bottom");
        }).on('hide.bs.collapse', function () {
            jQuery(this).parent().find(".glyphicon-triangle-bottom")
                .removeClass("glyphicon-triangle-bottom")
                .addClass("glyphicon-triangle-right");
        });
    });
</script>

<?php
$futureEvents = array();
$currentEvents = array();
$pastEvents = array();

foreach ( $this->items as $item ) {

    if ( new DateTime( $item->date ) < new DateTime() ){
        $pastEvents[$item->season_year][] = $item;
    } elseif ( $item->event_ticket == null ) {
        $futureEvents[] = $item;
    } else {
        $currentEvents[] = $item;
    }
}

?>

<h1>Events</h1>

<h2>Future Events</h2>
<?php //var_dump($futureEvents); ?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th width="30%">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( $futureEvents as $event ) {
        $eventUrl = JRoute::_( 'index.php?option=com_swa&view=event&event=' . $event->id );
        echo "<tr>\n";
        echo "<td><a href='$eventUrl'>" . $event->name . "</a></td>\n";
        echo "<td>" . $event->date . "</td>\n";
        echo "</tr>\n";
    } ?>
    </tbody>
</table>

<h2>Current Events</h2>
<?php //var_dump($currentEvents); ?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th width="30%">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( $currentEvents as $event ) {
        $eventUrl = JRoute::_( 'index.php?option=com_swa&view=event&event=' . $event->id );
        echo "<tr>\n";
        echo "<td><a href='$eventUrl'>" . $event->name . "</a></td>\n";
        echo "<td>" . $event->date . "</td>\n";
        echo "</tr>\n";
    } ?>
    </tbody>
</table>

<h2>Past Events</h2>
<?php //var_dump($pastEvents); ?>
<?php
foreach ( $pastEvents as $seasonYear => $events ) {
    $seasonYearId = str_replace('/', '-', $seasonYear);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse<?php echo $seasonYearId; ?>">
                <div>
                    <span class="glyphicon glyphicon-triangle-right"></span>
                    <?php echo $seasonYear; ?>
                </div>
            </a>
        </h4>
    </div>
    <div id="collapse<?php echo $seasonYearId; ?>" class="panel-collapse collapse">
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