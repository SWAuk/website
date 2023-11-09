<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined( '_JEXEC' ) or die;

HTMLHelper::addIncludePath( JPATH_COMPONENT . '/helpers/html' );
//HTMLHelper::_('behavior.tooltip');
//HTMLHelper::_('behavior.formvalidation');
HTMLHelper::_( 'formbehavior.chosen', 'select' );
HTMLHelper::_( 'behavior.keepalive' );
HTMLHelper::_( 'behavior.formvalidator' );

?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
	});

	Joomla.submitbutton = function (task) {
		let form = document.getElementById('member-form');
		if (task === 'member.cancel') {
			Joomla.submitform(task, form);
		} else {

			if (task !== 'member.cancel' && document.formvalidator.isValid(form)) {
				Joomla.submitform(task, form);
			} else {
				alert('<?= $this->escape( Text::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ) ) ?>');
			}
		}
	}
</script>

<form action="<?= Route::_( 'index.php?option=com_swa&layout=edit&id=' . (int) $this->item->id ) ?>"
	  method="post" enctype="multipart/form-data" name="adminForm" id="member-form" class="form-validate">

	<div class="form-horizontal">
		<?= HTMLHelper::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ) ?>

		<?= HTMLHelper::_( 'bootstrap.addTab', 'myTab', 'general',
			Text::_( 'Member', true ) ) ?>

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<!-- Hidden field hack so that unchecked checkboxes are saved -->
					<input type="hidden" name="jform[lifetime_member]" value="0">
					<input type="hidden" name="jform[club_committee]" value="0">
					<input type="hidden" name="jform[swa_committee]" value="0">

					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'id' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'id' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'user_id' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'user_id' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'lifetime_member' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'lifetime_member' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'gender' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'gender' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'pronouns' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'pronouns' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'ethnicity' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'ethnicity' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'dob' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'dob' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'tel' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'tel' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'university_id' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'university_id' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'club_committee' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'club_committee' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'level' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'level' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'race' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'race' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'econtact' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'econtact' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'enumber' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'enumber' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'dietary' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'dietary' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'swa_committee' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'swa_committee' ) ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?= $this->form->getLabel( 'medical' ) ?></div>
						<div class="controls"><?= $this->form->getInput( 'medical' ) ?></div>
					</div>

				</fieldset>
			</div>
		</div>
		<?= HTMLHelper::_( 'bootstrap.endTab' ) ?>
		<?= HTMLHelper::_( 'bootstrap.endTabSet' ) ?>

		<input type="hidden" name="task" value=""/>
		<?= HTMLHelper::_( 'form.token' ) ?>

	</div>
</form>
