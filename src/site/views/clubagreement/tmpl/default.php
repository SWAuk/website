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

	<h1>Agreement page</h1>
<?php
$db = JFactory::getDbo();
$user = JFactory::getUser();
$user_id = $user->id;
// Create a new query object.
$agreement_check = $db->getQuery(true);
$committee_check = $db->getQuery(true);

/*
We need to join this onto the university agreements page to see if there is a valid agreement
There are two cases, if there is a current agrement, then we need to check the date and the signed value.
Otherwise we need the member to create one.
*/

$agreement_check
    ->select('agr.*')
    ->from($db->quoteName('#__swa_member', 'smem'))
    ->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
				. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
				' = ' . $db->quoteName('suni.university_id'))
    ->join('INNER', $db->quoteName('#__university_agreements', 'agr') . " ON " .
				$db->quoteName('smem.university_id') . ' = ' . $db->quoteName('agr.university_id')
		)
    ->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user_id));

$db->setQuery($agreement_check);
$results = $db->loadRow();

// Check if valid agreement
$valid = false;
if ($results <> null) {
	if ($results['override'] == 1) {
		$valid = true;
	}
elseif ($results['signed'] == 1 && $results['date'] != null) {
		if (strtotime($results['date']) < strtotime('-1 year')) {
			// If valid agreement
			$valid = true;
			}
	}
}
$status = 'Valid agreement';

if (!$valid) {
	$committee_check
        ->select('count(*)')
        ->from($db->quoteName('#__swa_member', 'smem'))
        ->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
					. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
					' = ' . $db->quoteName('suni.university_id') . ' AND ' . $db->quoteName('suni.Committee') . " = 'Committee'")
        ->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user_id));

	$db->setQuery($committee_check);
	$content = null;
	$results = $db->loadResult();
	// If results = 1 then the user is commitee.

	if ($results == 1) {
		$status = 'No agreement, and is committee';
		// Committee to sign agreement
		$status .= '\n Will show update form.';
		$content = file_get_contents(JUri::root() . 'components/com_swa/assets/forms/UpdateClubDetailsForm.php');
		if ($content == null) {
			$content = "
	<div class='container'>
        <img class='ops' src=" . JUri::root() . 'components/com_swa/assets/images/404.svg' . " />
        <br />
        <div>Failed to load update form.
            <br /> Please email webmaster@swa.co.uk.</div>
        <br />
    </div>
			";
		}
	}
else {
		// Show page saying please get committee to sign agreement
		$status = 'No agreement, and is NOT committee';
		$status .= '\n Will show message telling to contact club.';
		$content = "<h2>Contact club or something</h2>";
	}
}
else {
	$status = 'How did you get here? Please continue with your day.';
}
echo "<H3>" . $status . "</H3>";
echo $content;

// Echo "<h3> Query For commitee used: " . str_replace('#_', 'swana', var_dump((string)$committee_check)) . "</h3><br>";
// echo "<h3> Query For agreement used: " . str_replace('#_', 'swana', var_dump((string)$agreement_check)) . "</h3>";


