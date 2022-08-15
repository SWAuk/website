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
			jQuery('#form-cupdate').submit(function (event) {
			});
		});
	});
</script>

<h1>Please update your clubs details.</h1>

<form id="form-cupdate-details" method="post"
	  action="<?php echo JRoute::_('index.php?option=com_swa&task=clubupdate'); ?>"
	  class="form-validate form-horizontal" enctype="multipart/form-data">
	<table class="table">
		<thead></thead>
		<tbody>

		<tr>
			<td>
				<p access="false" id="control-5833132">Every year we ask you to check and update your club’s contact
					details. These will only be used by SWA committee members to contact you and your committee with
					important information about issues that directly affect your club and occasionally about events that
					your club and its members are eligible to attend. Please remember to promote newly elected senior
					committee members to committee status on your ‘club page’ on the SWA website so they will have
					access to
					this form at the beginning of their term.</p>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_name'); ?></td>
			<td><?php echo $this->form->getInput('club_name'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('au_postcode'); ?></td>
			<td><?php echo $this->form->getInput('au_postcode'); ?></td>
		</tr>
		<tr>
			<td>
				<p access="false" id="control-3119673">Please provide a general club email address that multiple
					committee
					members have access to, and an email address that is regularly monitored by a senior committee
					member –
					they may be the same email address</p>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_email_1'); ?></td>
			<td><?php echo $this->form->getInput('club_email_1'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_email_2'); ?></td>
			<td><?php echo $this->form->getInput('club_email_2'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_email_1_confirm'); ?></td>
			<td><?php echo $this->form->getInput('club_email_1_confirm'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_email_2_confirm'); ?></td>
			<td><?php echo $this->form->getInput('club_email_2_confirm'); ?></td>
		</tr>
		<tr>
			<td>
				<p access="false" id="control-597674">Please nominate a member of your committee to act as a point of
					contact between the SWA and your club. We usually want to contact the president/chair or the
					treasurer,
					but you may nominate any member of your committee.</p>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_poc_name'); ?></td>
			<td><?php echo $this->form->getInput('club_poc_name'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_contact_method'); ?></td>
			<td><?php echo $this->form->getInput('club_contact_method'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_contact_value'); ?></td>
			<td><?php echo $this->form->getInput('club_contact_value'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_contact_value_confirm'); ?></td>
			<td><?php echo $this->form->getInput('club_contact_value_confirm'); ?></td>
		</tr>
		<tr>
			<td>
				<p access="false" id="control-3039380">Finally, please ensure your committee members have joined the SWA
					Presidents Group (for club committee members only), contact the Student Windsurf Facebook page if
					you
					need the first member of you committee to be invited to the page. Please ensure that your members
					have
					liked and followed the SWA Facebook Page https://www.facebook.com/studentwindsurf and Instagram
					account
					@studentwindsurf</p>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_information_agree'); ?></td>
			<td><?php echo $this->form->getInput('club_information_agree'); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('club_agreements_agree'); ?></td>
			<td><?php echo $this->form->getInput('club_agreements_agree'); ?></td>
		</tr>
		<tr>
			<td><label>Submitted by</label></td>
			<td><?php echo $this->user->name; ?></td>
		</tr>
		<tr>
			<td><?php echo $this->form->getLabel('id'); ?></td>
			<td><?php echo $this->form->getInput('id'); ?></td>
		</tr>


		<tr>
			<td>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="validate btn btn-primary">
							<?php echo JText::_('JSUBMIT'); ?>
						</button>
						<a class="btn" href="<?php echo JRoute::_(
								'index.php?option=com_swa&task=clubupdate.cancel'); ?>"
						   title="<?php echo JText::_('JCANCEL'); ?>">
							<?php echo JText::_('JCANCEL'); ?></a>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
	</table>

	<input type="hidden" name="option" value="com_swa"/>
	<!--	<input type="hidden" name="id" value=--><?php //$this->user->id?><!--/>-->
	<input type="hidden" name="task" value="clubupdate.submit"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
