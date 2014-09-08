<?php

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_swa/assets/js/form.js');
?>

<!--</style>-->
<script type="text/javascript">
	getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
		jQuery(document).ready(function() {
			jQuery('#form-member').submit(function(event) {
			});
		});
	});
</script>

<h1>Membership Details</h1>

<p>You can not currently edit your details!</p>

<table>

	<tr>
		<div class="control-group">
			<td>Member number:</td>
			<td><?php echo $this->item->id ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Paid:</td>
			<td><?php echo ( $this->item->paid ) ? 'Yes' : 'No' ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Confirmed:</td>
			<td><?php echo ( $this->item->university_confirmed ) ? 'Yes' : 'No' ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Sex:</td>
			<td><?php echo $this->item->sex ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Dob:</td>
			<td><?php echo $this->item->dob ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>University:</td>
			<td><?php echo $this->item->university ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Course:</td>
			<td><?php echo $this->item->course ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Graduation:</td>
			<td><?php echo $this->item->graduation ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Discipline:</td>
			<td><?php echo $this->item->discipline ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Level:</td>
			<td><?php echo $this->item->level ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Instructor level:</td>
			<td><?php echo $this->item->instructor ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Instructor confirmed level:</td>
			<td><?php echo $this->item->instructor_confirmed ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Shirt:</td>
			<td><?php echo $this->item->shirt ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Emerg Contact:</td>
			<td><?php echo $this->item->econtact ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>Emerg Number:</td>
			<td><?php echo $this->item->enumber ?></td>
		</div>
	</tr>

	<tr>
		<div class="control-group">
			<td>SWA help?:</td>
			<td><?php echo $this->item->swahelp ?></td>
		</div>
	</tr>

</table>