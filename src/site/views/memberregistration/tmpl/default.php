<?php

// no direct access
defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$doc = JFactory::getDocument();
$doc->addScript( JUri::base() . '/components/com_swa/assets/js/form.js' );
?>

<!--</style>-->
<script type="text/javascript">
	getScript( '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
		jQuery( document ).ready( function () {
			jQuery( '#form-member' ).submit( function ( event ) {
			} );
		} );
	} );
</script>

<div class="member-edit front-end-edit">

	<h1>Member Registration</h1>

	<form id="form-member" action="<?php echo JRoute::_(
		'index.php?option=com_swa&task=memberregistration.submit'
	); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

		<table>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'sex' ); ?></td>
					<td><?php echo $this->form->getInput( 'sex' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'dob' ); ?></td>
					<td><?php echo $this->form->getInput( 'dob' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'tel' ); ?></td>
					<td><?php echo $this->form->getInput( 'tel' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'university_id' ); ?></td>
					<td><?php echo $this->form->getInput( 'university_id' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'course' ); ?></td>
					<td><?php echo $this->form->getInput( 'course' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'graduation' ); ?></td>
					<td><?php echo $this->form->getInput( 'graduation' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'discipline' ); ?></td>
					<td><?php echo $this->form->getInput( 'discipline' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'level' ); ?></td>
					<td><?php echo $this->form->getInput( 'level' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'shirt' ); ?></td>
					<td><?php echo $this->form->getInput( 'shirt' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'econtact' ); ?></td>
					<td><?php echo $this->form->getInput( 'econtact' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'enumber' ); ?></td>
					<td><?php echo $this->form->getInput( 'enumber' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'dietary' ); ?></td>
					<td><?php echo $this->form->getInput( 'dietary' ); ?></td>
				</div>
			</tr>

			<tr>
				<div class="control-group">
					<td><?php echo $this->form->getLabel( 'swahelp' ); ?></td>
					<td><?php echo $this->form->getInput( 'swahelp' ); ?></td>
				</div>
			</tr>

			<tr>
				<td>
					<div class="control-group">
						<div class="controls">
							<button type="submit"
									class="validate btn btn-primary"><?php echo JText::_(
									'JSUBMIT'
								); ?></button>
							<a class="btn" href="<?php echo JRoute::_(
								'index.php?option=com_swa&task=memberregistration.cancel'
							); ?>" title="<?php echo JText::_( 'JCANCEL' ); ?>"><?php echo JText::_(
									'JCANCEL'
								); ?></a>
						</div>
					</div>
				</td>
			</tr>

			<input type="hidden" name="option" value="com_swa"/>
			<input type="hidden" name="task" value="memberregistration.submit"/>
			<?php echo JHtml::_( 'form.token' ); ?>
		</table>
	</form>
</div>
