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
    
    <form id="form-committee-details" method="post" 
          action="<?php echo JRoute::_('index.php?option=com_swa&task=orgcommitteedetails'); ?>" 
          class="form-validate form-horizontal" enctype="multipart/form-data">
        <table>
            <tr>
                <div>
                    <td>Name</td>
                    <td><?php echo $this->user->name; ?></td>
                </div>
            </tr>
            <tr>
                <div class="control-group">
                    <td><?php echo $this->form->getLabel('blurb'); ?></td>
                    <td><?php echo $this->form->getInput('blurb'); ?></td>
                </div>
            </tr>
        </table>
    </form>
</div>