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

<p>This event is on: <?php echo $item->event_date;?></p>
<p>You must buy tickets by: <?php echo $item->event_date_close;?></p>
<p>This event is part of the: <?php echo $item->season;?> season</p>

<?php
// Only show for the SWA committee or the hosts of the event
if( $this->member ) {
    $isHostCommittee = in_array($this->member->uni_id, explode(',', $item->hosts)) && $this->member->club_committee;
    if ($this->member->swa_committee || $isHostCommittee) {
?>

<h2>Ticket Sales</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Ticket Type</th>
            <th>Price</th>
            <th>% Sold</th>
            <th>Sold</th>
            <th>Quantity</th>
            <th>Remaining</th>
        </tr>
    </thead>
    <tbody>
<?php
    $ticketSales = $this->get( 'TicketSales' );
    $totalSold = 0;
    $totalQuantity = 0;
    $totalRemaining = 0;

    foreach( $ticketSales as $ticket ){
        $totalSold += $ticket['sold'];
        $totalQuantity += $ticket['quantity'];
        $totalRemaining += $ticket['remaining'];

        echo "<tr>\n";
        echo "<td>{$ticket['name']}</td>";
        echo "<td>£{$ticket['price']}</td>";
        echo "<td>{$ticket['percentage_sold']}</td>";
        echo "<td>{$ticket['sold']}</td>";
        echo "<td>{$ticket['quantity']}</td>";
        echo "<td>{$ticket['remaining']}</td>";
        echo "</tr>\n";
    }

    $totalPercentSold = round($totalSold / $totalQuantity * 100);
?>
    </tbody>
    <tfoot>
        <tr>
            <td><label>Totals</label></td>
            <td><label>-</label></td>
            <td><label><?php echo $totalPercentSold ?>%</label></td>
            <td><label><?php echo $totalSold ?></label></td>
            <td><label><?php echo $totalQuantity ?></label></td>
            <td><label><?php echo $totalRemaining ?></label></td>
        </tr>
    </tfoot>
</table>
<?php
}}
