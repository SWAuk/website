<?php
// no direct access
defined( '_JEXEC' ) or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$canEdit = JFactory::getUser()->authorise( 'core.edit', 'com_swa.' . $this->item->id );
if ( !$canEdit && JFactory::getUser()->authorise( 'core.edit.own', 'com_swa' . $this->item->id ) ) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ( $this->item && $this->item->state == 1 ) : ?>

	<div class="item_fields">
		<table class="table">
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_ID' ); ?></th>
				<td><?php echo $this->item->id; ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_STATE' ); ?></th>
				<td>
					<i class="icon-<?php echo ( $this->item->state == 1 ) ? 'publish' : 'unpublish'; ?>"></i>
				</td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_CREATED_BY' ); ?></th>
				<td><?php echo $this->item->created_by_name; ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_NAME' ); ?></th>
				<td><?php echo $this->item->name; ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_CODE' ); ?></th>
				<td><?php echo $this->item->code; ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_URL' ); ?></th>
				<td><?php echo $this->item->url; ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_( 'COM_SWA_FORM_LBL_UNIVERSITY_PASSWORD' ); ?></th>
				<td><?php echo $this->item->password; ?></td>
			</tr>

		</table>
	</div>
	<?php if ( $canEdit && $this->item->checked_out == 0 ): ?>
		<a class="btn" href="<?php echo JRoute::_( 'index.php?option=com_swa&task=university.edit&id=' . $this->item->id ); ?>"><?php echo JText::_( "COM_SWA_EDIT_ITEM" ); ?></a>
	<?php endif; ?>
	<?php if ( JFactory::getUser()->authorise( 'core.delete', 'com_swa.university.' . $this->item->id ) ): ?>
		<a class="btn" href="<?php echo JRoute::_( 'index.php?option=com_swa&task=university.remove&id=' . $this->item->id, false, 2 ); ?>"><?php echo JText::_( "COM_SWA_DELETE_ITEM" ); ?></a>
	<?php endif; ?>
<?php
else:
	echo JText::_( 'COM_SWA_ITEM_NOT_LOADED' );
endif;
?>
