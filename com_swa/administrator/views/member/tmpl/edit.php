<?php

// no direct access
defined( '_JEXEC' ) or die;

JHtml::addIncludePath( JPATH_COMPONENT . '/helpers/html' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );
JHtml::_( 'behavior.keepalive' );

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet( 'components/com_swa/assets/css/swa.css' );
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
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_( 'index.php?option=com_swa&layout=edit&id=' . (int)$this->item->id ); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="member-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ); ?>

		<?php echo JHtml::_( 'bootstrap.addTab', 'myTab', 'general', JText::_( 'COM_SWA_TITLE_MEMBER', true ) ); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'id' ); ?></div>
					</div>
					<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
					<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>"/>
					<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
					<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>"/>

					<?php if ( empty( $this->item->created_by ) ) { ?>
						<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>"/>

					<?php
					} else {
						?>
						<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>"/>

					<?php } ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'user_id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'user_id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'sex' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'sex' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'dob' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'dob' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'university' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'university' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'course' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'course' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'graduation' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'graduation' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'discipline' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'discipline' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'level' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'level' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'instructor' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'instructor' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'shirt' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'shirt' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'econtact' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'econtact' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'enumber' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'enumber' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'swahelp' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'swahelp' ); ?></div>
					</div>

				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_( 'bootstrap.endTab' ); ?>



		<?php echo JHtml::_( 'bootstrap.endTabSet' ); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_( 'form.token' ); ?>

	</div>
</form>