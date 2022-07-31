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
		if (task == 'universityagreement.cancel') {
			Joomla.submitform(task, document.getElementById('universityagreement-form'));
		}
		else {

			if (task != 'universityagreement.cancel' && document.formvalidator.isValid(document.id('universityagreement-form'))) {
				Joomla.submitform(task, document.getElementById('universityagreement-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id); ?>"
	  method="post" enctype="multipart/form-data" name="adminForm" id="university_agreement-form"
      class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general',
			JText::_('University Agreement', true)); ?>

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<!-- Hidden field hack so that unchecked checkboxes are saved -->
					<input type="hidden" name="jform[graduated]" value="0">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('member_id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('member_id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('university_id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('university_id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('date'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('date'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('signed'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('signed'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('override'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('override'); ?></div>
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
