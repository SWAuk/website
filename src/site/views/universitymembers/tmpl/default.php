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

<h1> <?php echo $this->items[0]->university ?>  Members</h1>
<?php //var_dump($this->items); die; ?>
<div  class="well well-small">
	View all current, pending and committee members of your club.
</div>

<div role="navigation">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#current" aria-controls="current" role="tab" data-toggle="tab">Current</a>
		</li>
		<li role="presentation">
			<a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending</a>
		</li>
		<li role="presentation">
			<a href="#committee" aria-controls="committee" role="tab" data-toggle="tab">Committee</a>
		</li>
	</ul>

	<!-- START Tab Panes -->
	<div class="tab-content">
		<!-- Current Tab Pane -->
		<div role="tabpanel" class="tab-pane active" id="current">

			<div class="well well-small">

			</div>

			<table class="table table-hover">
				<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Level</th>
					<th>Action</th>
					<th>Event Registration</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $member)
				{
					if (!$member->approved)
					{
						continue;
					}

					echo "<tr>\n";
					echo "<td>{$member->id}</td>\n";
					echo "<td>{$member->name}</td>\n";
					echo "<td>{$member->level}</td>\n";

					$formId = "form-unapprove-{$member->id}";
					$url = JRoute::_('index.php?option=com_swa&task=universitymembers.unapprove');
					?>
					<td>
						<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
							<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
							<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
								(unapprove)
							</a>
							<?php echo JHtml::_('form.token') ?>
						</form>
					</td>
					<td>
						<ul>
							<?php
							foreach ($this->events as $event)
							{
								// Skip this event if registration hasn't opened
								if ($event->date_open > date("Y-m-d"))
								{
									continue;
								}

								echo "<li>{$event->name}";
								if (array_key_exists($member->id, $eventRegistrations)
									&& array_key_exists($event->id, $eventRegistrations[$member->id]))
								{
									$formId = "form-unregister-{$member->id}-{$event->id}";
									$url = JRoute::_('index.php?option=com_swa&task=universitymembers.unregister');
									?>
									<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
										<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
										<input type="hidden" name="event_id" value="<?php echo $event->id ?>">
										<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
											(unregister)
										</a>
										<?php echo JHtml::_('form.token') ?>
									</form>
									<?php
								} else {
									$formId = "form-register-{$member->id}-{$event->id}";
									$url = JRoute::_('index.php?option=com_swa&task=universitymembers.register');
									?>
									<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
										<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
										<input type="hidden" name="event_id" value="<?php echo $event->id ?>">
										<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
											(register)
										</a>
										<?php echo JHtml::_('form.token') ?>
									</form>
									<?php
								}
								echo "</li>";
							}
							?>
						</ul>
					</td>
					<?php
					echo "</tr>\n";
				}
				?>
				</tbody>
			</table>
		</div>

		<!-- Pending Tab Pane -->
		<div role="tabpanel" class="tab-pane" id="pending">
			<div  class="well well-small">
				<div>
					Here you can see all the members that have paid their SWA Membership and said they are part of
					<strong><?php echo $this->items[0]->university ?></strong>.
				</div>
				<p></p>
				<div>If you don't see a member here it means they haven't bought or renewed their SWA Membership.</div>
				<div>Even lifetime members need to renew their membership but it won't cost them anything.</div>
				<p></p>
				<div style="color: #b94a48;">
					By approving a member from <strong>Pending</strong> into <strong>Current</strong> you are confirming
					that they are a member of you club and are covered by your clubs insurance.
				</div>
			</div>

			<table class="table table-hover">
				<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Level</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $member)
				{
					if ($member->approved)
					{
						continue;
					}

					echo "<tr>\n";
					echo "<td>{$member->id}</td>\n";
					echo "<td>{$member->name}</td>\n";
					echo "<td>{$member->level}</td>\n";

					$formId = "form-approve-{$member->id}";
					$url = JRoute::_('index.php?option=com_swa&task=universitymembers.approve');
					?>
					<td>
						<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
							<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
							<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
								(approve)
							</a>
							<?php echo JHtml::_('form.token') ?>
						</form>
					</td>
				<?php
					echo "</tr>\n";
				} ?>
				</tbody>
			</table>
		</div>

		<!-- Committee Tab Pane -->
		<div role="tabpanel" class="tab-pane" id="committee">

			<h3>Committee Members</h3>
			<div class="well well-small">

			</div>

			<table class="table table-hover">
				<thead>
				<tr>
					<th width="10%">ID</th>
					<th width="40%">Name</th>
					<th width="30%">Position</th>
					<th width="20%">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $member)
				{
					if (!$member->club_committee)
					{
						continue;
					}

					echo "<tr>\n";
					echo "<td>{$member->id}</td>\n";
					echo "<td>{$member->name}</td>\n";
					echo "<td>{$member->club_committee}</td>\n";

					$formId = "form-removecommittee-{$member->id}";
					$url = JRoute::_('index.php?option=com_swa&task=universitymembers.removecommittee');
					?>
					<td>
						<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
							<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
							<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
								(remove)
							</a>
							<?php echo JHtml::_('form.token') ?>
						</form>
					</td>
					<?php
					echo "</tr>\n";
				} ?>
				</tbody>
			</table>

			<h3>Standard Members</h3>
			<div class="well well-small">
				Here you can promote people to your committee.
				Doing so gives them access to the "Club" section of the SWA website.
			</div>

			<table class="table table-hover">
				<thead>
				<tr>
					<th width="10%">ID</th>
					<th width="40%">Name</th>
					<th width="30%">Level</th>
					<th width="20%">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $member)
				{
					if ($member->club_committee)
					{
						continue;
					}

					echo "<tr>\n";
					echo "<td>{$member->id}</td>\n";
					echo "<td>{$member->name}</td>\n";
					echo "<td>{$member->level}</td>\n";

					$formId = "form-addcommittee-{$member->id}";
					$url = JRoute::_('index.php?option=com_swa&task=universitymembers.addcommittee');
					?>
					<td>
						<form id="<?php echo $formId ?>" method="POST" action="<?php echo $url ?>">
							<input type="hidden" name="member_id" value="<?php echo $member->id ?>">
							<a href="javascript:{}" onclick="document.getElementById('<?php echo $formId ?>').submit(); return false;">
								(add to committee)
							</a>
							<?php echo JHtml::_('form.token') ?>
						</form>
					</td>
					<?php
					echo "</tr>\n";
				} ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- END Tab Panes -->

</div>

<div><p></p></div>

<!-- TODO: remove from view.html.php too -->
<p><strong>View:
		<?php
		foreach ($this->layouts as $layout => $text)
		{
			$href = JRoute::_('index.php?option=com_swa&view=universitymembers&layout=' . $layout);
			echo "<a href='$href' title='$text' style='padding: 5px'>" . ucfirst($layout) . "</a>\n";
		}
		?>
	</strong></p>

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

	foreach ($memberIds as $memberId)
	{
		if (!array_key_exists($memberId, $eventRegistrations)
			|| !array_key_exists($event->id, $eventRegistrations[$memberId])
		)
		{
			$toRegisterForThisEvent[] = $memberId;
		}
	}

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
		<th>Id</th>
		<th>Name</th>
		<th>SWA Member</th>
		<th>Committee</th>
		<th>Discipline</th>
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
		echo "<td>" . $item->discipline . "</td>\n";
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
