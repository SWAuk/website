<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Pre-process items
$eventData  = array();
$ticketData = array();

foreach ($this->items as $item)
{
	if (!array_key_exists($item->id, $eventData))
	{
		$eventData[$item->id]['name']       = $item->name;
		$eventData[$item->id]['date_open']  = $item->date_open;
		$eventData[$item->id]['date_close'] = $item->date_close;
		$eventData[$item->id]['date']       = $item->date;
	}

	$ticketData[$item->id][] = array(
		'member_id'   => $item->member_id,
		'member_name' => $item->member_name,
		'ticket_name' => $item->ticket_name,
	);
}
?>

	<!--</style>-->
	<script type="text/javascript">
		getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
			jQuery(document).ready(function () {
				jQuery('#form-member').submit(function (event) {
				});
			});
		});
	</script>

	<h1><?php echo $this->member->university_name ?> Event Attendees</h1>

	<p>
		This lists attendees for your university to future events,
		if you do not see an event it is possible no one has yet bought a ticket.
	</p>

<?php
foreach ($eventData as $eventId => $event)
{
	?>
	<h2><?php echo "{$event['name']}" ?></h2>
	<p>
		<label>Date open: </label> <?php echo " {$event['date_open']}" ?>,
		<label>Date close: </label> <?php echo " {$event['date_close']}" ?>,
		<label>Date : </label> <?php echo " {$event['date']}" ?>
	</p>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Ticket</th>
		</tr>
		</thead>
		<tbody>
	<?php
	foreach ($ticketData[$eventId] as $ticket)
	{
		echo "<tr>";
		echo "<td>" . $ticket['member_id'] . "</td>";
		echo "<td>" . $ticket['member_name'] . "</td>";
		echo "<td>" . $ticket['ticket_name'] . "</td>";
		echo "</tr>";
	}

	echo "</tbody>";
	echo "</table>";
}
