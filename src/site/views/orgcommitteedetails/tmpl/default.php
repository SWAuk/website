<?php

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_swa/assets/js/form.js');
?>

<!--</style>-->
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
	jQuery(document).ready(function() {
            jQuery('#form-orgcommitteedetails').submit(function(event) {
            });
	});
    });
</script>

<div class="org-committee-details front-end-edit">
    <h1>Change Committee Details</h1>

    <p>Note: You can currently only change your blurb!</p>
    
    <form id="form-committee-details" method="post" 
          action="<?php echo JRoute::_('index.php?option=com_swa&task=orgcommitteedetails'); ?>" 
          class="form-validate form-horizontal" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Name</td>
                <td><?php echo $this->user->name; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->form->getLabel('id'); ?></td>
                <td><?php echo $this->form->getInput('id'); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->form->getLabel('member_id'); ?></td>
                <td><?php echo $this->form->getInput('member_id'); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->form->getLabel('position'); ?></td>
                <td><?php echo $this->form->getInput('position'); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->form->getLabel('blurb'); ?></td>
                <td><?php echo $this->form->getInput('blurb'); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->form->getLabel('image'); ?></td>
                <td><?php echo $this->form->getInput('image'); ?></td>
            </tr>

            <tr><td>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                            <a class="btn" href="<?php echo JRoute::_('index.php?option=com_swa&task=orgcommitteedetails.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                        </div>
                    </div>
                </td></tr>

            <input type="hidden" name="option" value="com_swa" />
            <input type="hidden" name="task" value="orgcommitteedetails.submit" />
            <?php echo JHtml::_('form.token'); ?>

        </table>
    </form>
</div>