<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();

$sponsor_array = array();
foreach ($this->sponsors as $sponsor) {
	$sponsor_array[] = $sponsor;
}
usort($sponsor_array, fn ($a, $b) => strcmp($a->sponsor_level, $b->sponsor_level));
?>

<p> </p>
<p>If you are interested in sponsoring the SWA, please contact us at <a href="mailto: sponsors@swa.co.uk">sponsors@swa.co.uk</a>!</p>
<p>The SWA runs the greatest student windsurfing series in the UK.
	In previous years we have teamed up with some of the biggest names in the industry to bring our competitors a line of truly epic prizes for each event.
	The best student riders from around the country will be battling it out to win the top prizes.</p>
<p><strong>This year's sponsors are.......</strong></p>

<?php

echo '<table><tbody>';

foreach ($sponsor_array as $row) {
	echo '<tr>';
	switch ($row->sponsor_level) {
		case 1:
			echo '<td><strong>Gold Sponsor</strong></td>';
			break;
		case 2:
			echo '<td><strong>Silver Sponsor</strong></td>';
			break;
		default:
			echo '<td><p>Bronze Sponsor</p></td>';
			break;
	};
	echo '<td><img width="600px" height="600px" src=' . $row->logo_url . '></td>';
	echo '<td><h4>' . $row->name . "</h4><p>" . $row->blurb . '</p></td>';
	echo '</tr>';
}
echo '</tbody></table>';
