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

//We need to join this onto the university agreements page to see if there is a valid agreement
//There are two cases, if there is a current agrement, then we need to check the date and the signed value.
//Otherwise we need the member to create one.

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

//check if valid agreement
$valid = false;
if ($results['override'] == 1) {
	$valid = true;
} else if ($results['signed'] == 1 && $results['date'] != null) {
	if (strtotime($results['date']) < strtotime('-1 year')) {
		//if valid agreement
		$valid = true;
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

	$results = $db->loadResult(); //if results = 1 then the user is commitee.

	if ($results == 1) {
		$status = 'No agreement, and is committee';//committee to sign agreement
		$status .= '\n Will show update form.';
	} else {
		//show page saying please get committee to sign agreement
		$status = 'No agreement, and is NOT committee';
		$status .= '\n Will show message telling to contact club.';
	}
}else{
	$status = 'How did you get here? Please continue with your day.';
}
echo "<H3>" . $status . "</H3>";
//echo "<h3> Query For commitee used: " . str_replace('#_', 'swana', var_dump((string)$committee_check)) . "</h3><br>";
//echo "<h3> Query For agreement used: " . str_replace('#_', 'swana', var_dump((string)$agreement_check)) . "</h3>";

?>
