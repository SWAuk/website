<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		console.log(task);
		if (task == 'membership.cancel' || document.formvalidator.isValid(document.getElementById('membership-form')))
		{
			Joomla.submitform(task, document.getElementById('membership-form'));
		}
	};
");
?>

<form method="post" name="adminForm" id="membership-form" class="form-validate form-horizontal">
	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'membership')); ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'membership', JText::_('Membership', true)); ?>
	<div class="row-fluid">
		<fieldset class="adminform">
			<?php foreach ($this->form->getFieldset() as $field): ?>
				<div class="control-group">
					<div class="control-label"><?php echo $field->label; ?></div>
					<div class="controls"><?php echo $field->input; ?></div>
				</div>
			<?php endforeach; ?>
		</fieldset>
	</div>

	<input type="hidden" name="task" value="membership.edit" />
	<?php echo JHtml::_('form.token'); ?>

	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php echo JHtml::_('bootstrap.endTabSet'); ?>
</form>
