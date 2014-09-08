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
		if (task == 'teamresult.cancel') {
			Joomla.submitform(task, document.getElementById('teamresult-form'));
		}
		else {

			if (task != 'teamresult.cancel' && document.formvalidator.isValid(document.id('teamresult-form'))) {

				Joomla.submitform(task, document.getElementById('teamresult-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_( 'index.php?option=com_swa&layout=edit&id=' . (int)$this->item->id ); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="teamresult-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ); ?>

		<?php echo JHtml::_( 'bootstrap.addTab', 'myTab', 'general', JText::_( 'Team result', true ) ); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'race_id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'race_id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'university_id' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'university_id' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'team_number' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'team_number' ); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel( 'result' ); ?></div>
						<div class="controls"><?php echo $this->form->getInput( 'result' ); ?></div>
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