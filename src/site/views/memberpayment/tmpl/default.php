<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$jconfig = JFactory::getConfig();
?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
	jQuery(document).ready(function () {
		jQuery('#form-member').submit(function (event) {
		});
	});
</script>

<h1>Membership Payment</h1>

<form action="<?php echo JRoute::_('index.php?option=com_swa&task=memberpayment'); ?>" method="POST">
	<input type="hidden" name="option" value="com_swa"/>
	<input type="hidden" name="task" value="memberpayment.submit"/>
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $jconfig->get('stripe_publishable_key'); ?>"
		data-amount="500"
		data-currency="GBP"
		data-label="Buy Membership"
		data-name="SWA"
		data-description="SWA Membership"
		data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
		data-locale="auto"
		data-zip-code="true"
		data-email="<?php echo $this->user->email ?>"
		data-allow-remember-me="false">
	</script>
</form>

<p>Note: If you have been redirected here after already paying try refreshing.</p>
<p>If the problem continues please email webmaster@swa.co.uk.</p>
