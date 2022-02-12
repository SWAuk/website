<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$item = $this->item;


function addonTable($addonString)
{
    $obj = json_decode($addonString, true);
    $headers = array_map(function ($key): string {
        return "<td>" . $key . "</td>";
    }, array_keys($obj["addons"]));

    $quantities = [];
    $options = [];

    foreach ($obj["addons"] as $addon) {
        array_push($quantities, array_key_exists("qty", $addon) ? $addon["qty"] : 0);
        array_push($options, array_key_exists("option", $addon) ? $addon["option"] : "");
    }

/*
Uncomment to include headers
array_unshift($headers, "<td>&nbsp;</td>");
array_unshift($quantities, "Quantity");
array_unshift($options, "Options");
*/

    $html = "<table class='remove_first_row_line'><tbody>";
    for ($i = 0; $i < count($headers); $i++) {
        $html = $html . "<tr>" . $headers[$i] . "<td>" . $quantities[$i] . "</td><td>" . $options[$i] . "</td></tr>";
    }
    $html = $html . "</tbody></table>";
    return $html;
}
?>
<style>
    .remove_first_row_line tr:first-child td{
        border-top: none !important;
    }
</style>
<div class="lead"><h1><?php echo $item->event_name ?></h1></div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div>Event Details</div>
		</h3>
	</div>
	<div id="collapseDetails" class="panel-collapse collapse in">
		<div class="panel-body">
			<p>This event is on: <?php echo $item->event_date; ?></p>
			<p>You must buy tickets by: <?php echo $item->event_date_close; ?></p>
			<p>This event is part of the: <?php echo $item->season; ?> season</p>
		</div>
	</div>
</div>

<?php
// Only show for the SWA committee or the hosts of the event
if ($this->member)
{
	$hostUniversities = explode(',', $item->hosts);
	$isHostCommittee  = in_array($this->member->university_id, $hostUniversities) && $this->member->club_committee;

	if ($this->member->swa_committee || $isHostCommittee)
	{
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Ticket Sales</h3>
			</div>
			<div id="collapseSales" class="panel-collapse collapse in">
				<div class="panel-body">
					<?php
					$ticketSales = $this->get('TicketSales');
					$eventAttendees = $this->get('EventAttendees');

					if (empty($ticketSales))
					{
						echo "There is no ticket information to show at this time.";
					}
					else
					{
						?>
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
							$totalSold      = 0;
							$totalQuantity  = 0;
							$totalRemaining = 0;

							foreach ($ticketSales as $ticket)
							{
								$totalSold      += $ticket['sold'];
								$totalQuantity  += $ticket['quantity'];
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
						<table class="table table-hover">
							<thead>
							<tr>
								<th>University</th>
								<th>Tickets Sold</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$universityCounts = array();
							$levelCounts = array();

							foreach ($eventAttendees as $person)
							{
								$universityCounts[$person['Uni']] += 1;
								if (strpos(strtolower($person['Ticket']), 'party') === false)
								{
									$levelCounts[$person['Level']] += 1;
								}
							}
							arsort($universityCounts);
							arsort($levelCounts);
							foreach ($universityCounts as $uni => $count)
							{
								echo "<tr>\n";
								echo "<td>{$uni}</td>";
								echo "<td>{$count}</td>";
								echo "</tr>\n";
							}
							?>
							</tbody>
						</table>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Level</th>
								<th>Non-Party Tickets Sold</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($levelCounts as $level => $count)
							{
								echo "<tr>\n";
								echo "<td>{$level}</td>";
								echo "<td>{$count}</td>";
								echo "</tr>\n";
							}
							?>
							</tbody>
						</table>

						<?php
							// Only show the full attendees table until the end of the event
							if (time() < (72 * 60 * 60 + strtotime($item->event_date)))
							{
							?>
							<table class="table table-hover">
								<thead>
								<tr>
									<th>Name</th>
									<th>University</th>
									<th>Ticket</th>
									<th>Level</th>
									<th>Food</th>
									<th>Details</th>
								</tr>
								</thead>
								<tbody>
							<?php
							foreach ($eventAttendees as $person)
							{
								if ($person['Dietary'] == "NULL")
								{
									$person['Dietary'] = "";
									}
								if ($person['Details'] == "{\"addons\":[]}")
								{
									$person['Details'] = "";
									}
								echo "<tr>\n";
								echo "<td>{$person['Name']}</td>";
								echo "<td>{$person['Uni']}</td>";
								echo "<td>{$person['Ticket']}</td>";
								echo "<td>{$person['Level']}</td>";
								echo "<td>{$person['Dietary']}</td>";
                            	echo "<td>" . addonTable($person['Details']) . "</td>";
								echo "</tr>\n";
								}
								}
							?>
							</tbody>
						</table>
					<?php } ?>

				<?php $baseURL = 'index.php?option=com_swa&task=event.downloadAttendees&event='; ?>
					<a href="<?php echo JRoute::_($baseURL . (int) $item->event_id); ?>" target="_blank">
						<h4>Download Event Attendees</h4>
					</a>
				</div>
			</div>
		</div>
	<?php }
} ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Event Results</h3>
	</div>

	<div class="panel-body">
		<?php

		$indiResults = $this->get('IndiResults');
		$teamResults = $this->get('TeamResults');

		if (empty($indiResults) && empty($teamResults))
		{
			echo "There are no results to show at this time.";
		}
		else
		{
			if ($teamResults)
			{
				?>
				<h2>Team Results</h2>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="10%">#</th>
						<th width="45%">Uni</th>
						<th width="40%">Team</th>
						<th width="5%">Points</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$positionCounter = 0;

					foreach ($teamResults as $result)
					{
						$positionCounter++;
						echo "<tr>\n";
						echo "<td>{$positionCounter}</td>\n";
						echo "<td>{$result['name']}</td>\n";
						echo "<td>{$result['team_number']}</td>\n";
						echo "<td>{$result['result']}</td>\n";
						echo "</tr>\n";
					} ?>
					</tbody>
				</table>
			<?php }

			foreach ($indiResults as $compName => $results)
			{
				echo "<h2>{$compName} Results</h2>\n";
				?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="10%">#</th>
						<th width="45%">Name</th>
						<th width="40%">University</th>
						<th width="5%">Points</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$positionCounter = 0;

					foreach ($results as $result)
					{
						$positionCounter++;
						$name = strip_tags($result['name']);
						$uni  = strip_tags($result['university']);
						echo "<tr>\n";
						echo "<td>{$positionCounter}</td>\n";
						echo "<td>{$name}</td>\n";
						echo "<td>{$uni}</td>\n";
						echo "<td>{$result['result']}</td>\n";
						echo "</tr>\n";
					} ?>

					</tbody>
				</table>
			<?php }
		} ?>
	</div>
</div>
