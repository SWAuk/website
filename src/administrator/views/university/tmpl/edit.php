<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_swa/assets/css/swa.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {

	});

	Joomla.submitbutton = function (task) {
		if (task == 'university.cancel') {
			Joomla.submitform(task, document.getElementById('university-form'));
		}
		else {

			if (task != 'university.cancel' && document.formvalidator.isValid(document.id('university-form'))) {
				Joomla.submitform(task, document.getElementById('university-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id); ?>"
	  method="post" enctype="multipart/form-data" name="adminForm" id="university-form"
      class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general',
			JText::_('University', true)); ?>

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('url'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('url'); ?></div>
					</div>



					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('au_address'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('au_address'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('au_additional_address'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('au_additional_address'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('au_postcode'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('au_postcode'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('club_email_1'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('club_email_1'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('club_email_2'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('club_email_2'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('club_contact_name'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('club_contact_name'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('club_contact_method'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('club_contact_method'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('club_contact_value'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('club_contact_value'); ?></div>
					</div>


				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
