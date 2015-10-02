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
	js( document ).ready( function () {

	} );

	Joomla.submitbutton = function ( task ) {
		if ( task == 'eventticket.cancel' ) {
			Joomla.submitform( task, document.getElementById( 'eventticket-form' ) );
		}
		else {

			if ( task != 'eventticket.cancel' && document.formvalidator.isValid( document.id( 'eventticket-form' ) ) ) {

				Joomla.submitform( task, document.getElementById( 'eventticket-form' ) );
			}
			else {
				alert( '<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>' );
			}
		}
	}
</script>

<form action="<?php echo JRoute::_(
	'index.php?option=com_swa&layout=edit&id=' . (int)$this->item->id
); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="eventticket-form"
	  class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ); ?>

		<?php echo JHtml::_(
			'bootstrap.addTab',
			'myTab',
			'general',
			JText::_( 'Event Ticket', true )
		); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<!-- Hidden field hack so that unchecked checkboxes are saved -->
					<input type="hidden" name="jform[need_swa]" value="0">
					<input type="hidden" name="jform[need_xswa]" value="0">
					<input type="hidden" name="jform[need_host]" value="0">
					<input type="hidden" name="jform[need_qualification]" value="0">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'id'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'id' ); ?></div>
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
								'name'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'name' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'quantity'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'quantity'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'price'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'price' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'need_swa'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'need_swa'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'need_xswa'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'need_xswa'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'need_host'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'need_host'
							); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel(
								'need_qualification'
							); ?></div>
						<div class="controls"><?php echo $this->form->getInput(
								'need_qualification'
							); ?></div>
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