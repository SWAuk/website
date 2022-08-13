<?php
defined('_JEXEC') or die('Restricted access');
?>
<form action="<?php echo JRoute::_('index.php?option=com_swa&view=fclubupdate&layout=edit'); ?>"
	  method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

	<?php echo $this->form->renderField('message');  ?>

	<?php echo $this->form->renderField('email');  ?>

	<?php echo $this->form->renderField('telephone');  ?>

	<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('myform.submit')">Submit</button>

	<input type="hidden" name="task" />
	<?php echo JHtml::_('form.token'); ?>
</form>
