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

<h1>Qualifications</h1>

<p>Below you are able to manage your current qualifications.</p>

<?php
if( empty( $this->items ) ) {
	echo "<p>You do not have any qualifications registered with us!</p>";
} else {
	?>

	<table>
		<tr>
			<th>Id</th>
			<th>Type</th>
			<th>Expiry</th>
			<th>Approved</th>
			<th>File</th>
		</tr>

		<?php
		foreach ( $this->items as $item ) {
			echo "<tr>\n";
			echo "<td>" . $item->id . "</td>\n";
			echo "<td>" . $item->type . "</td>\n";
			if ( new DateTime( $item->expiry ) < new DateTime() ) {
				echo "<td bgcolor='#FF6666'>";
			} else {
				echo "<td>";
			}
			echo $item->expiry;
			echo "</td>";
			if ( !$item->approved ) {
				echo "<td bgcolor='#FF6666'>";
			} else {
				echo "<td>";
			}
			echo $item->approved;
			echo "</td>";
			$imgSrc =
				JRoute::_(
					'index.php?option=com_swa&task=qualifications.viewImage&qualification=' .
					$item->id
				);
			echo "<td><a href='$imgSrc'><img src='$imgSrc' height='50' width='50'/></a></td>";
			echo "</tr>\n";
		}
		?>

	</table>

	<?php
}
?>

<h2>Add new qualification</h2>

<div class="qualification front-end-edit">
	<form id="form-qualification" method="post"
		  action="<?php echo JRoute::_( 'index.php?option=com_swa&task=qualifications' ); ?>"
		  class="form-validate form-horizontal" enctype="multipart/form-data">
		<table>
			<tr>
				<td><?php echo $this->form->getLabel( 'type' ); ?></td>
				<td><?php echo $this->form->getInput( 'type' ); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->form->getLabel( 'expiry_date' ); ?></td>
				<td><?php echo $this->form->getInput( 'expiry_date' ); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->form->getLabel( 'file_upload' ); ?></td>
				<td><?php echo $this->form->getInput( 'file_upload' ); ?></td>
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
								'index.php?option=com_swa&task=qualifications.cancel'
							); ?>" title="<?php echo JText::_( 'JCANCEL' ); ?>"><?php echo JText::_(
									'JCANCEL'
								); ?></a>
						</div>
					</div>
				</td>
			</tr>

			<input type="hidden" name="option" value="com_swa"/>
			<input type="hidden" name="task" value="qualifications.add"/>
			<?php echo JHtml::_( 'form.token' ); ?>
		</table>
	</form>
</div>