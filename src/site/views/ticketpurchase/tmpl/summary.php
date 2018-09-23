<?php

defined('_JEXEC') or die;

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);

$jconfig   = JFactory::getConfig();
$app       = JFactory::getApplication();
$jinput    = $app->input;
$option    = $jinput->get('option');
$ticket_id = $app->getUserState("$option.ticket_id");
$ticket    = null;

foreach ($this->items as $item)
{
	if ($item->id == $ticket_id)
	{
		$ticket = $item;
		break;
	}
}

if ($ticket === null)
{
	echo "<p><b>There has been an error retrieving the selected ticket. ";
	echo "If this problem continues contact us at webmaster@swa.co.uk</b>";
	echo "<a href='{JRoute::_('index.php?option=com_swa&task=ticketpurchase')}'>";
	echo "Click here to return to the ticket purchase page.</a></p>";
	die;
}

?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
	jQuery(document).ready(function () {
		$tshirt_size = jQuery('#tshirt_size');
		$addons = jQuery(".swa-addon");
		// If we have a tshirt or addons
		if ($tshirt_size.length || $addons.length) {
			// Then disable the stripe button
			$stripeBtn = jQuery('.stripe-button-el');
			$stripeBtn.prop('disabled', true);

			// Define a check to happen when one of our inputs changes
			$ticketCheck = function (event) {
				$addons = jQuery(".swa-addon");
				$ticketPrice = parseInt(jQuery(".swa-ticket").attr('data-price'));

				// Add together the price of addons we have and update total
				$addonsPrice = 0;
				$addons.each((function(i, obj){
					if ( jQuery(obj).val() != "NULL" ) {
						$addonQuantity = parseInt( jQuery(obj).val() );
						$addonPrice = parseInt( jQuery(obj).attr('data-price') );
						this.$addonsPrice += ( $addonQuantity * $addonPrice )

					}
				}).bind(this));

				$total = $ticketPrice + $addonsPrice;
				$total = Number($total).toFixed(2);
				jQuery('.stripe-button-el span')[0].innerHTML = "Pay £" + $total + " now!";

				// Check if the stripe button should be enabled
				$buttonEnabled = true;
				$elementsToCheck = jQuery('#tshirt_size').add($addons);
				$elementsToCheck.each((function(i, obj){
					if ( jQuery(obj).val() == "NULL" ) {
						this.$buttonEnabled = false;
					}
				}).bind(this));
				jQuery('.stripe-button-el').prop('disabled', !$buttonEnabled);
			};

			// Listen to input changes
			jQuery('#tshirt_size').add(jQuery(".swa-addon")).change(function (event) {
				$ticketCheck(event);
			});
		}
	});
</script>

<h1>Order Summary</h1>


<form action="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase'); ?>" method="POST">
	<input type="hidden" name="option" value="com_swa"/>
	<input type="hidden" name="task" value="ticketpurchase.submit"/>
	<input type="hidden" name="return" value="index.php?option=com_swa&view=membertickets"/>
	<input type="hidden" name="ticketId" value="<?php echo $ticket->id ?>"/>

	<table class="table">
		<tr>
			<th>Qty</th>
			<th>Product</th>
			<th>Price</th>
		</tr>
		<tr class="swa-ticket" data-price="<?php echo $ticket->price; ?>">
			<td>1</td>
			<td>
				<div><?php echo $ticket->event_name . ' - ' . $ticket->ticket_name ?></div>
				<?php if (!empty($ticket->details->tshirt_included))
					:
					?>
					<div style="font-size: 10pt; margin-left: 20px;">
						T-Shirt Size:
						<select id="tshirt_size" name="tshirt_size">
							<option value='NULL'>-- SELECT --</option>
							<option value='Unisex S (35/37")'>Unisex S (35/37")</option>
							<option value='Unisex M (38/40")'>Unisex M (38/40")</option>
							<option value='Unisex L (41/43")'>Unisex L (41/43")</option>
							<option value='Unisex XL (44/46")'>Unisex XL (44/46")</option>
							<option value='Unisex XXL (47/49")'>Unisex XXL (47/49")</option>
						</select>
					</div>
				<?php endif ?>
			</td>
			<td><?php echo '£' . $ticket->price; ?></td>
		</tr>
		<?php
		if (isset($ticket->details) && isset($ticket->details->addons) && !empty($ticket->details->addons))
		{
			foreach ($ticket->details->addons as $key => $addon)
			{
				?>
				<tr>
					<td>
						<select class="swa-addon" id="<?php echo "addon_{$key}" ?>" name="<?php echo "addon_{$key}" ?>"
						        data-price="<?php echo $addon->price ?>">
							<option value="NULL">-- SELECT --</option>
							<option value="0">0</option>
							<option value="1">1</option>
						</select>
					</td>
					<td><?php echo $addon->name . '<br/>' . $addon->description ?></td>
					<td>£<?php echo number_format($addon->price, 2) ?></td>
				</tr>
				<?php
			}
		}
		?>
	</table>

	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $jconfig->get('stripe_publishable_key'); ?>"
		data-amount="<?php echo $ticket->price * 100 ?>"
		data-currency="GBP"
		data-label="Pay <?php echo '£' . $ticket->price; ?> now!"
		data-name="SWA"
		data-description="<?php echo $ticket->event_name . ' - ' . $ticket->ticket_name; ?>"
		data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
		data-locale="auto"
		data-zip-code="true"
		data-email="<?php echo $this->user->email ?>"
		data-allow-remember-me="false">
	</script>
</form>
