<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
	});

	Joomla.submitbutton = function (task) {
		if (task == 'member.cancel') {
			Joomla.submitform(task, document.getElementById('member-form'));
		}
		else {

			if (task != 'member.cancel' && document.formvalidator.isValid(document.id('member-form'))) {
				Joomla.submitform(task, document.getElementById('member-form'));
			} else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" enctype="multipart/form-data" name="adminForm" id="member-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('Member', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<!-- Hidden field hack so that unchecked checkboxes are saved -->
					<input type="hidden" name="jform[lifetime_member]" value="0">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('user_id'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('lifetime_member'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('lifetime_member'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('sex'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('sex'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('ethnicity'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('ethnicity'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('tel'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('tel'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('econtact'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('econtact'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('enumber'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('enumber'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('dietary'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('dietary'); ?></div>
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
