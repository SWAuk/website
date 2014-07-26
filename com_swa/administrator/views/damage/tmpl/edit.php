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
		if (task == 'damage.cancel') {
			Joomla.submitform(task, document.getElementById('damage-form'));
		}
		else {

			if (task != 'damage.cancel' && document.formvalidator.isValid(document.id('damage-form'))) {

				Joomla.submitform(task, document.getElementById('damage-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_( 'index.php?option=com_swa&layout=edit&id=' . (int)$this->item->id ); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="damage-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ); ?>

		<?php echo JHtml::_( 'bootstrap.addTab', 'myTab', 'general', JText::_( 'COM_SWA_TITLE_DAMAGE', true ) ); ?>
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
						<div class="control-label"><?php echo $this->form->getLabel( 'event_id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'event_id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'university_id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'university_id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'date' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'date' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'cost' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'cost' ); ?></div>
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