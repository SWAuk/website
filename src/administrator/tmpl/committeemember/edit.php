<?php

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

// Import CSS
$document = Factory::getDocument();
$webAssetManager = $document->getWebAssetManager();
\Joomla\CMS\Log\Log::add("Detailing webasset manager assets");
\Joomla\CMS\Log\Log::add( json_encode($webAssetManager->getAssets("script")));
\Joomla\CMS\Log\Log::add( json_encode($webAssetManager->getAssets("style")));
//$webAssetManager->useStyle("swa_css"); //TODO Re-enable this
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		let form = document.getElementById('committeemember-form');
		if (task === 'committeemember.cancel') {
			Joomla.submitform(task, form);
		}
		else {

			if (task !== 'committeemember.cancel' && document.formvalidator.isValid(form)) {
				Joomla.submitform(task, form);
			}
			else {
				alert('<?= $this->escape(Text::_('JGLOBAL_VALIDATION_FORM_FAILED')) ?>');
			}
		}
	}
</script>

<form action="<?= Route::_(
	'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id) ?>"
      method="post" enctype="multipart/form-data" name="adminForm" id="committeemember-form"
      class="form-validate">

	<div class="form-horizontal">
		<?= HTMLHelper::_('bootstrap.startTabSet', 'myTab', array( 'active' => 'general')) ?>

		<?= HTMLHelper::_('bootstrap.addTab',	'myTab', 'general',
			Text::_('Committee Member', true)) ?>

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
		<?= HTMLHelper::_('bootstrap.endTab') ?>
		<?= HTMLHelper::_('bootstrap.endTabSet') ?>

		<input type="hidden" name="task" value=""/>
		<?= HTMLHelper::_('form.token') ?>

	</div>
</form>
