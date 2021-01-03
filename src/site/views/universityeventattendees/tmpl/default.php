<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Pre-process items
$eventData  = array();
$ticketData = array();

if ($this->items) {
	foreach ($this->items as $item) {
		if (!array_key_exists($item->event_id, $eventData)) {
			$eventData[$item->event_id] = array(
				'name'		 => $item->event_name,
				'date'		 => $item->event_date,
				'date_open'	 => $item->event_date_open,
				'date_close' => $item->event_date_close,
			);
		}

		$ticketData[$item->event_id][] = array(
			'ticket_id'   => $item->ticket_id,
			'member_id'   => $item->member_id,
			'member_name' => $item->member_name,
			'ticket_name' => $item->ticket_name,
		);
	}
}
?>

<script type="text/javascript">
	getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
		jQuery(document).ready(function() {
			jQuery('#form-member').submit(function(event) {});
		});
	});
</script>

<h1><?php echo $this->member->university_name ?> Event Attendees</h1>

<div class="favth-well">
	This lists attendees for your university to future events,
	if you do not see an event it is possible no one has yet bought a ticket.
</div>

<?php foreach ($eventData as $eventId => $event) : ?>
	<h2><?php echo $event['name'] ?></h2>

	<div class="favth-row">
		<div class="favth-col-md-2"><label>Event Date : </label> <?php echo " {$event['date']}" ?></div>
		<div class="favth-col-md-2"><label>Tickets Open: </label> <?php echo " {$event['date_open']}" ?></div>
		<div class="favth-col-md-2"><label>Tickets Close: </label> <?php echo " {$event['date_close']}" ?></div>
	</div>

	<table class="favth-table favth-table-hover">
		<thead>
			<tr>
				<th width="10%">Ticket ID</th>
				<th width="40%">Member Name (ID)</th>
				<th>Ticket</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ticketData[$eventId] as $ticket) : ?>
				<tr>
					<td><?php echo $ticket['ticket_id']; ?></td>
					<td><?php echo "{$ticket['member_name']} ({$ticket['member_id']})"; ?></td>
					<td><?php echo $ticket['ticket_name']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach;
