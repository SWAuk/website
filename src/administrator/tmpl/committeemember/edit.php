<?php

use Joomla\CMS\Factory;
use Joomla\Router\Route;

defined('_JEXEC') or die;

//JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = Factory::getDocument();
//$document->addStyleSheet('components/com_swa/assets/css/swa.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {

	});

	Joomla.submitbutton = function (task) {
		if (task == 'committeemember.cancel') {
			Joomla.submitform(task, document.getElementById('committeemember-form'));
		}
		else {

			if (task != 'committeemember.cancel' && document.formvalidator.isValid(document.id('committeemember-form'))) {
				Joomla.submitform(task, document.getElementById('committeemember-form'));
			}
			else {
				alert('<?= $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')) ?>');
			}
		}
	}
</script>

<form action="<?= Route::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id) ?>"
      method="post" enctype="multipart/form-data" name="adminForm" id="committeemember-form"
      class="form-validate">

	<div class="form-horizontal">
		<?= JHtml::_('bootstrap.startTabSet', 'myTab', array( 'active' => 'general')) ?>

		<?= JHtml::_('bootstrap.addTab',	'myTab', 'general',
			JText::_('Committee Member', true)) ?>

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel('member_id') ?></div>
						<div class="controls"><?= $this->form->getInput('member_id') ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel('position') ?></div>
						<div class="controls"><?= $this->form->getInput('position') ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel('blurb') ?></div>
						<div class="controls"><?= $this->form->getInput('blurb') ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel('image') ?></div>
						<div class="controls"><?= $this->form->getInput('image') ?></div>
					</div>

				</fieldset>
			</div>
		</div>
		<?= JHtml::_('bootstrap.endTab') ?>
		<?= JHtml::_('bootstrap.endTabSet') ?>

		<input type="hidden" name="task" value=""/>
		<?= JHtml::_('form.token') ?>

	</div>
</form>
