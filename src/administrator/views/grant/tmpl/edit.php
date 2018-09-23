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
		if (task == 'grant.cancel') {
			Joomla.submitform(task, document.getElementById('grant-form'));
		}
		else {

			if (task != 'grant.cancel' && document.formvalidator.isValid(document.id('grant-form'))) {

				Joomla.submitform(task, document.getElementById('grant-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id
); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="grant-form"
      class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('Grant', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'event_id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'event_id'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'application_date'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'application_date'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'amount'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput('amount'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'fund_use'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'fund_use'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'instructions'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'instructions'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'ac_sortcode'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'ac_sortcode'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'ac_number'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'ac_number'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'ac_name'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'ac_name'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'finances_date'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'finances_date'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'finances_id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'finances_id'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'auth_date'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'auth_date'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'auth_id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'auth_id'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'payment_date'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'payment_date'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'payment_id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'payment_id'
							); ?></div>
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
