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
			jQuery('#form-member').submit(function(event) {
			});
		});
	});
</script>

<h1>Membership Payment</h1>

<form method="POST" action="https://secure.nochex.com/">
	<input type="hidden" name ="merchant_id" value="swa.web@gmail.com" />
	<input type="hidden" name ="amount" value="5.00" />
	<input type="hidden" name ="description" value="SWA Membership for <?php echo $this->user->name; ?>" />
	<input type="hidden" name ="order_id" value="j3membership:<?php echo $this->item->id; ?>" />
	<input type="hidden" name ="callback_url" value="<?php echo JUri::root() . 'index.php?option=com_swa&task=memberpayment.callback' ?>" />
	<!--TODO use an image relative to this install here-->
	<input type="image" alt="Pay on Credit or Debit Card with Nochex" src="http://www.studentwindsurfing.co.uk/images/swacore/paybutton.gif"/>

	<!-- test_transaction = 100 means TEST-->
	<input type="hidden" name ="test_transaction" value="0" />
</form>