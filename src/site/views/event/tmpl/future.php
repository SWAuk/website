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

<p>This event is on: <?php echo $item->date;?></p>
<p>You must buy tickets by: <?php echo $item->date_close;?></p>
<p>This event is part of the: <?php echo $item->season;?> season</p>

<?php
//Only show for SWA committee currently
if( $this->member && $this->member->swa_committee ) {
    echo "<h2>Ticket Sales</h2>";
    echo "<table border=\"1\">\n";
    echo "<th>\n";
    echo "<td><strong>Price</strong></td>\n";
    echo "<td><strong>% Sold</strong></td>\n";
    echo "<td><strong>Sold</strong></td>\n";
    echo "<td><strong>Quantity</strong></td>\n";
    echo "<td><strong>Remaining</strong></td>\n";
    echo "</th>\n";

    $ticketSales = $this->get( 'TicketSales' );
    foreach( $ticketSales as $ticket ){
        echo "<tr>\n";
        echo "<td>{$ticket['name']}</td>";
        echo "<td>£{$ticket['price']}</td>";
        echo "<td>{$ticket['percentage_sold']}</td>";
        echo "<td>{$ticket['sold']}</td>";
        echo "<td>{$ticket['quantity']}</td>";
        echo "<td>{$ticket['remaining']}</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
}