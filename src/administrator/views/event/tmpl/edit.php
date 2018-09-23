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
		if (task == 'event.cancel') {
			Joomla.submitform(task, document.getElementById('event-form'));
		}
		else {

			if (task != 'event.cancel' && document.formvalidator.isValid(document.id('event-form'))) {

				Joomla.submitform(task, document.getElementById('event-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id
); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="event-form"
      class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('Event', true)); ?>
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
								'name'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'season_id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'season_id'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'capacity'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'capacity'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'date_open'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'date_open'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'date_close'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'date_close'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'date'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput('date'); ?></div>
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
