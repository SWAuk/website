<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_swa/assets/js/form.js');
$app = JFactory::getApplication();
$user = JFactory::getUser();
$db = JFactory::getDbo();
$valid_agreement = $db->getQuery(true);
$valid_agreement
    ->select('agr.*')
    ->from($db->quoteName('#__swa_member', 'smem'))
    ->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
				. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
				' = ' . $db->quoteName('suni.university_id'))
    ->join('INNER', $db->quoteName('#__university_agreements', 'agr') . " ON " .
				$db->quoteName('smem.university_id') . ' = ' . $db->quoteName('agr.university_id')
		)
    ->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user->id));

$db->setQuery($valid_agreement);
$results = $db->loadObject();
// Check if valid agreement
$valid = false;
if (is_null($results)) {
	$valid = false;
}
elseif ($results->override == 1) {
	$valid = true;
}
elseif ($results->signed == 1 && $results->date != null) {
	if (strtotime($results->date) > strtotime('-1 year')) {
		// If valid agreement
		$valid = true;
	}
}


if (!$valid) {
	$committee_check = $db->getQuery(true)
        ->select('count(*)')
        ->from($db->quoteName('#__swa_member', 'smem'))
        ->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
					. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
					' = ' . $db->quoteName('suni.university_id') . ' AND ' . $db->quoteName('suni.Committee') . " = 'Committee'")
        ->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user->id));

	$db->setQuery($committee_check);
	$results = $db->loadResult();
	// If results = 1 then the user is commitee.

	if ($results == 1) {
		$status = 'No agreement, and is committee';
		$app->redirect(JRoute::_('index.php?option=com_swa&view=clubupdate', false));
	}
else {
		// Show page saying please get committee to sign agreement
		$app->enqueueMessage("You will not be able to purchase tickets until your club lead has
		updated their details and agreed to the SWA terms. Please alert them.");
			$status = 'No agreement, and is NOT committee';
	}
}

?>

	<h1>Ticket Purchasing</h1>

<?php
if (empty($this->items)) {
	echo "<p><b>There are currently no tickets that you can buy!</b></p>";
}
elseif ($valid) {
	?>
	<p>Tickets are sometimes released in batches, if one is marked as 'SOLD OUT' check back soon!</p>
	<p>If you can not see any tickets here then maybe there are no events? Make sure your committee has registered you
		for the event! If you want an instructor ticket make sure you have submitted your qualifications.</p>
	<p>Keep an eye on social media as we will post about all ticket releases there!</p>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Event</th>
			<th>Event Date</th>
			<th>Ticket Deadline</th>
			<th>Ticket</th>
			<th>Price</th>
			<th>Notes</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($this->items as $item) {
			echo "<tr>\n";
			echo "<td>" . $item->event_name . "</td>\n";
			echo "<td>" . $item->event_date . "</td>\n";
			echo "<td>" . $item->ticket_close . "</td>\n";
			echo "<td>" . $item->ticket_name . "</td>\n";

			if (isset($item->details) && isset($item->details->addons) && !empty($item->details->addons)) {
				echo "<td>From: £" . $item->price . "*</td>\n";
			}
else {
				echo "<td>£" . $item->price . "</td>\n";
			}

			echo "<td>" . $item->notes . "</td>\n";
			echo "<td>";

			if ($item->reason) {
				echo $item->reason;
			}
else {
				?>
				<form action="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase') ?>" method="POST">
					<input type="hidden" name="option" value="com_swa"/>
					<input type="hidden" name="task" value="ticketpurchase.select"/>
					<input type="hidden" name="ticketId" value="<?php echo $item->id ?>"/>
					<button class="btn favth-btn-small" type="submit">Select</button>
				</form>
				<?php
			}

			echo "</td>\n";
			echo "</tr>\n";
		}
		?>
		</tbody>
	</table>
	<small>* Addons optionally increase price.</small>
	<?php
}
