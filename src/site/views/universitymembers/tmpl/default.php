<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$eventRegistrations = array();

foreach ($this->event_registrations as $reg)
{
	@$eventRegistrations[$reg->member_id][$reg->event_id] = true;
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

<h1>Members (current)</h1>

<p><strong>View:
		<?php
		foreach ($this->layouts as $layout => $text)
		{
			$href = JRoute::_('index.php?option=com_swa&view=universitymembers&layout=' . $layout);
			echo "<a href='$href' title='$text' style='padding: 5px'>" . ucfirst($layout) . "</a>\n";
		}
		?>
	</strong></p>

<p>Here you can see all current registered members of your university that you have approved.</p>

<?php
// EWWWW allow people to register ALL people that are currently unregistered for an event
$memberIds = array();

foreach ($this->items as $item)
{
	if ($item->confirmed_university && !$item->graduated)
	{
		$memberIds[] = $item->id;
	}
}


foreach ($this->events as $event)
{
	// Skip this event if registration hasn't opened
	if ($event->date_open > date("Y-m-d"))
	{
		continue;
	}

	$toRegisterForThisEvent = array();
    $toUnRegisterForThisEvent = array();

	foreach ($memberIds as $memberId)
	{
		if (!array_key_exists($memberId, $eventRegistrations)
            || !array_key_exists($event->id, $eventRegistrations[$memberId])
        ) {
            $toRegisterForThisEvent[] = $memberId;
        }
		else {
            $toUnRegisterForThisEvent[] = $memberId;
        }
	}

    echo '<form id="form-universitymembers-unregister-all-' . $event->id . '" method="POST" 
	onsubmit="return confirm(\'Are you sure you want to unregister everyone ' . $event->name . '?\');" action="' .
        JRoute::_('index.php?option=com_swa&task=universitymembers.unregister') .
        '">' .
        '<input type="hidden" name ="member_ids" value="' . implode('|', $toUnRegisterForThisEvent) . '" />' .
        '<input type="hidden" name ="event_id" value="' . $event->id . '" />' .
        '<a href="javascript:{}" 
		onclick="document.getElementById(\'form-universitymembers-unregister-all-' . $event->id . '\').requestSubmit(); return false;">
		Unregister all for ' . $event->name . '</a>' .
        JHtml::_('form.token') .
        '</form>';

	// TODO it is stupid to send the member ids like this... We shouldnt do this...
	echo '<form id="form-universitymembers-register-all-' . $event->id . '" method="POST" action="' .
		JRoute::_('index.php?option=com_swa&task=universitymembers.register') . '">' .
		'<input type="hidden" name ="member_ids" value="' . implode('|', $toRegisterForThisEvent) . '" />' .
		'<input type="hidden" name ="event_id" value="' . $event->id . '" />' .
		'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-register-all-' . $event->id . '\').submit(); return false;">Register all for ' . $event->name . '</a>' .
		JHtml::_('form.token') .
		'</form></br>';
}
?>

<table class="table table-hover">
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>SWA Member</th>
		<th>Committee</th>
		<th>Level</th>
		<th>Action</th>
		<th>Event Registration</th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($this->items as $item)
	{
		if (!$item->confirmed_university || $item->graduated)
		{
			continue;
		}

		echo "<tr>\n";
		echo "<td>" . $item->id . "</td>\n";
		echo "<td>" . $item->name . "</td>\n";

		// Check if the member has paid their SWA membership
		if ($item->season_id != null || $item->lifetime_member)
		{
			echo "<td bgcolor='#CCFF33'>Yes</td>\n";
		}
		else
		{
			echo "<td bgcolor='#FF6666'>No</td>\n";
		}

		echo "<td>" . ($item->club_committee ? 'Yes' : 'No') . "</td>\n";
		echo "<td>" . $item->level . "</td>\n";

		echo '<td>';
		echo '<form id="form-universitymembers-graduate-' .
			$item->id .
			'" method="POST" action="' .
			JRoute::_('index.php?option=com_swa&task=universitymembers.graduate') .
			'">' .
			'<input type="hidden" name ="member_id" value="' .
			$item->id .
			'" />' .
			'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-graduate-' .
			$item->id .
			'\').submit(); return false;">(graduate)</a>' .
			JHtml::_('form.token') .
			'</form>';
		echo '<form id="form-universitymembers-unapprove-' .
			$item->id .
			'" method="POST" action="' .
			JRoute::_('index.php?option=com_swa&task=universitymembers.unapprove') .
			'">' .
			'<input type="hidden" name ="member_id" value="' .
			$item->id .
			'" />' .
			'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-unapprove-' .
			$item->id .
			'\').submit(); return false;">(unapprove)</a>' .
			JHtml::_('form.token') .
			'</form>';
		echo '</td>';

		echo "<td><ul>";

		foreach ($this->events as $event)
		{
			// Skip this event if registration hasn't opened
			if ($event->date_open > date("Y-m-d"))
			{
				continue;
			}

			echo "<li>" . $event->name . ' ';

			if (array_key_exists($item->id, $eventRegistrations)
				&& array_key_exists($event->id, $eventRegistrations[$item->id])
			)
			{
				// Registered for the event
				echo '<form id="form-universitymembers-unregister-' . $item->id . '-' . $event->id . '" method="POST" action="' .
					JRoute::_('index.php?option=com_swa&task=universitymembers.unregister') .
					'">' .
					'<input type="hidden" name ="member_id" value="' .
					$item->id .
					'" />' .
					'<input type="hidden" name ="event_id" value="' .
					$event->id .
					'" />' .
					'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-unregister-' . $item->id . '-' . $event->id . '\').submit(); return false;">(unregister)</a>' .
					JHtml::_('form.token') .
					'</form>';
			}
			else
			{
				// Not registered for the event
				echo '<form id="form-universitymembers-register-' . $item->id . '-' . $event->id . '" method="POST" action="' .
					JRoute::_('index.php?option=com_swa&task=universitymembers.register') .
					'">' .
					'<input type="hidden" name ="member_id" value="' .
					$item->id .
					'" />' .
					'<input type="hidden" name ="event_id" value="' .
					$event->id .
					'" />' .
					'<a href="javascript:{}" onclick="document.getElementById(\'form-universitymembers-register-' . $item->id . '-' . $event->id . '\').submit(); return false;">(register)</a>' .
					JHtml::_('form.token') .
					'</form>';
			}

			echo "</li>\n";
		}

		echo "</ul></td>\n";
		echo "</tr>\n";
	}
	?>
	</tbody>
</table>
