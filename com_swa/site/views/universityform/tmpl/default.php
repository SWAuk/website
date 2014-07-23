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
</style>
< script type

=
"text/javascript"
>
getScript
(
'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'
,
function
(
)
{
jQuery
(
document

)
.

ready
(
function
(
)
{
jQuery
(
'#form-university'
)
.

submit
(
function
(
event

)
{

}
)
;

}
)
;
}
)
;

<

/
script >
< div class

=
"university-edit front-end-edit"
>
<?php if (!empty($this->item->id)): ?>
< h1 > Edit <?php echo $this->item->id; ?><

/
h1 > <?php else: ?> < h1 > Add<

/
h1 > <?php endif; ?> < form id

=
"form-university"
action

=
"
<?php echo JRoute::_('index.php?option=com_swa&task=university.save'); ?>
"
method

=
"post"
class

=
"form-validate form-horizontal"
enctype

=
"multipart/form-data"
>

< div class

=
"control-group"
>
< div class

=
"control-label"
>
<?php echo $this->form->getLabel('id'); ?><

/
div >
< div class

=
"controls"
>
<?php echo $this->form->getInput('id'); ?><

/
div >
<

/
div >
< input type

=
"hidden"
name

=
"jform[ordering]"
value

=
"
<?php echo $this->item->ordering; ?>
"
/
>

< input type

=
"hidden"
name

=
"jform[state]"
value

=
"
<?php echo $this->item->state; ?>
"
/
>

< input type

=
"hidden"
name

=
"jform[checked_out]"
value

=
"
<?php echo $this->item->checked_out; ?>
"
/
>

< input type

=
"hidden"
name

=
"jform[checked_out_time]"
value

=
"
<?php echo $this->item->checked_out_time; ?>
"
/
>

<?php if(empty($this->item->created_by)): ?>
< input type

=
"hidden"
name

=
"jform[created_by]"
value

=
"
<?php echo JFactory::getUser()->id; ?>
"
/
>
<?php else: ?>
< input type

=
"hidden"
name

=
"jform[created_by]"
value

=
"
<?php echo $this->item->created_by; ?>
"
/
>
<?php endif; ?>
< div class

=
"control-group"
>
< div class

=
"control-label"
>
<?php echo $this->form->getLabel('name'); ?><

/
div >
< div class

=
"controls"
>
<?php echo $this->form->getInput('name'); ?><

/
div >
<

/
div >
< div class

=
"control-group"
>
< div class

=
"control-label"
>
<?php echo $this->form->getLabel('code'); ?><

/
div >
< div class

=
"controls"
>
<?php echo $this->form->getInput('code'); ?><

/
div >
<

/
div >
< div class

=
"control-group"
>
< div class

=
"control-label"
>
<?php echo $this->form->getLabel('url'); ?><

/
div >
< div class

=
"controls"
>
<?php echo $this->form->getInput('url'); ?><

/
div >
<

/
div >
< div class

=
"control-group"
>
< div class

=
"control-label"
>
<?php echo $this->form->getLabel('password'); ?><

/
div >
< div class

=
"controls"
>
<?php echo $this->form->getInput('password'); ?><

/
div >
<

/
div > < div class

=
"fltlft"
<?php if (!JFactory::getUser()->authorise('core.admin','swa')): ?>
style

=
"display:none;"
<?php endif; ?>
>
<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
<?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
< fieldset class

=
"panelform"
>
<?php echo $this->form->getLabel('rules'); ?>
<?php echo $this->form->getInput('rules'); ?>
<

/
fieldset > <?php echo JHtml::_('sliders.end'); ?> <

/
div > <?php if (!JFactory::getUser()->authorise('core.admin','swa')): ?> < script type

=
"text/javascript"
>
jQuery.

noConflict
(
)
;
jQuery
(
'.tab-pane select'
)
.

each
(
function
(
)
{
	var option_selected = jQuery(this) . find(':selected')
;
	var input = document . createElement("input")
;
	input . setAttribute("type", "hidden")
;
	input . setAttribute("name", jQuery(this) . attr('name'))
;
	input . setAttribute("value", option_selected . val())
;
	document . getElementById("form-university") . appendChild(input)
;
}
)
;
<

/
script > <?php endif; ?> < div class

=
"control-group"
>
< div class

=
"controls"
>
< button type

=
"submit"
class

=
"validate btn btn-primary"
>
<?php echo JText::_('JSUBMIT'); ?><

/
button >
< a class

=
"btn"
href

=
"
<?php echo JRoute::_('index.php?option=com_swa&task=universityform.cancel'); ?>
"
title

=
"
<?php echo JText::_('JCANCEL'); ?>
"
>
<?php echo JText::_('JCANCEL'); ?><

/
a >
<

/
div >
<

/
div >
< input type

=
"hidden"
name

=
"option"
value

=
"com_swa"
/
>
< input type

=
"hidden"
name

=
"task"
value

=
"universityform.save"
/
>
<?php echo JHtml::_('form.token'); ?>
<

/
form >
<

/
div >
