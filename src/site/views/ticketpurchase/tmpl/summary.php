<?php

defined('_JEXEC') or die;

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);

$jConfig = JFactory::getConfig();
$app     = JFactory::getApplication();
$ticket  = null;

foreach ($this->items as $item) {
	if ($item->id == $this->ticket_id) {
		$ticket = $item;
		break;
	}
}

if ($ticket == null) {
	$app->enqueueMessage('Purchase failed because the session expired - please try again.', 'Error');
	$app->redirect(JRoute::_('index.php?option=com_swa&view=ticketpurchase'));
}
?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
	jQuery(document).ready(function() {

		$addons = jQuery('.swa-addon');
		if ($addons.length > 0) {
			$qtySelectors = jQuery('.swa-qty-selector');
			$optionSelectors = jQuery('.swa-option-selector');

			// disable the stripe button
			$stripeBtn = jQuery('#button');
			$stripeBtn.prop('disabled', true);

			// disable and hide all option selectors
			$optionSelectors.prop('disabled', true);
			$optionSelectors.parent().prop('hidden', true);

			// define function to calculate the total ticket price
			$totalTicketPrice = function() {
				$ticketPrice = parseFloat(jQuery(".swa-ticket").attr('data-price'));

				$totalAddonsPrice = 0;
				$addons.each(function(i, obj) {
					$addonQty = parseInt(obj.value);
					if ($addonQty > 0) {
						$addonPrice = parseFloat(obj.getAttribute('data-price'));
						$totalAddonsPrice += $addonPrice * $addonQty
					}
				});

				$totalPrice = $ticketPrice + $totalAddonsPrice;
				$totalPrice = $totalPrice.toFixed(2);
				// stripe amount is in pence
				$stripeBtn.attr('data-amount', $totalPrice * 100);
				jQuery('#stripe-button span')[0].innerHTML = "Pay £" + $totalPrice + " now!";

			};

			// define function to enable/disable stripe button
			$updateDisplayedTotal = function(event) {
				$stripeBtnEnabled = true;

				$qtySelectors.each(function(i, obj) {
					$value = obj.value;
					if ($value > 0) {
						if (jQuery('#select_' + obj.getAttribute('data-id')).val() == "NULL") {
							$stripeBtnEnabled = false;
							// break out of the .each loop
							return false;
						}
					} else if ($value == "NULL") {
						$stripeBtnEnabled = false;
						// break out of the .each loop
						return false;
					}
				});

				$stripeBtn.prop('disabled', !$stripeBtnEnabled)
			};

			// define function to enable/disable the option
			$qtyChanged = function(event) {
				// get the option selector for this addon
				$option = jQuery('#select_' + event.target.getAttribute('data-id'));

				// if qty dropdown is greater than zero
				if (event.target.value > 0) {
					// show and enable the option selector
					$option.parent().prop('hidden', false);
					$option.prop('disabled', false);
				} else {
					// hide, reset and disable option selector
					$option.parent().prop('hidden', true);
					$option.val('NULL');
					$option.prop('disabled', true);
				}

				$totalTicketPrice();
				$updateDisplayedTotal(event)
			};

			$qtySelectors.change(function(event) {
				$qtyChanged(event);
			});

			$optionSelectors.change(function(event) {
				$updateDisplayedTotal(event);
			});
		}
	});
</script>

<!-- <link rel="stylesheet" href="global.css" /> -->
<script src="https://js.stripe.com/v3/"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

<h1>Order Summary</h1>

<form id="payment-form" method="POST" enctype="multipart/form-data"> <!-- action="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase'); ?>" -->
	<!-- <input type="hidden" name="option" value="com_swa" />
	<input type="hidden" name="task" value="ticketpurchase.submit" />
	<input type="hidden" name="return" value="index.php?option=com_swa&view=membertickets" /> -->


	<div class="table-responsive favth-table-responsive">
		<table class="table favth-table">
			<tr>
				<th class="col-sm-2 favth-col-sm-2">Qty</th>
				<th class="col-sm-9 favth-col-sm-9">Product</th>
				<th class="col-sm-1 favth-col-sm-1">Price</th>
			</tr>
			<tr class="swa-ticket" data-price="<?php echo $ticket->price; ?>">
				<td>1</td>
				<td>
					<div><?php echo "{$ticket->event_name} - {$ticket->ticket_name}" ?></div>
				</td>
				<td><?php echo '£' . $ticket->price; ?></td>
			</tr>
			<?php
			if (isset($ticket->details) && isset($ticket->details->addons) && !empty($ticket->details->addons)) {
				foreach ($ticket->details->addons as $key => $addon) {
			?>
					<tr>
						<td>
							<select id="<?php echo "addon_{$key}" ?>" name="<?php echo "addons[{$key}][qty]" ?>" data-id="<?php echo $key ?>" class="swa-addon swa-qty-selector" style="width: 60px" data-price="<?php echo $addon->price ?>">
								<option value="NULL">--</option>
								<option value="0">0</option>
								<option value="1">1</option>
							</select>
						</td>
						<td>
							<div><?php echo "{$addon->name}<br/>{$addon->description}" ?></div>
							<?php
							if (isset($addon->options) && !empty($addon->options)) {
								$option = $addon->options;
							?>
								<div style="font-size: 10pt; margin-left: 20px;">
									<?php echo "{$option->name}:" ?>
									<select id="<?php echo "select_{$key}" ?>" name="<?php echo "addons[{$key}][option]" ?>" data-id="<?php echo $key ?>" class="swa-option-selector" data-price="<?php echo $option->price ?>">
										<option value='NULL'>-- SELECT --</option>
										<?php foreach ($option->values as $value) {
										?>
											<option value='<?php echo $value->value ?>'>
												<?php echo $value->label ?>
											</option>
										<?php } ?>
									</select>
								</div>
							<?php } ?>
						</td>
						<td>£<?php echo number_format($addon->price, 2) ?></td>
					</tr>
			<?php
				}
			}
			?>

			<!--Add line to end of table-->
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>

		</table>
	</div>
	<h2 id="payment-total">Total: <?php echo $ticket->price ?> GBP</h2>
	<div id="card-element">
		<!--Stripe.js injects the Card Element-->
	</div>
	<!-- <button class="btn btn-primary btn-lg" id="stripe-button">Pay Now</button> -->
	<button id="stripe-button">
		<div class="spinner hidden" id="spinner"></div>
		<span id="button-text">Pay</span>
	</button>
	<p id="card-error" role="alert"></p>
	<p class="result-message hidden">
		Payment succeeded, see the result in your
		<a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
	</p>
</form>


<script type="text/javascript">
	var generateAddonList = function() {
		$selectedAddons = [];
		$addons = jQuery('.swa-addon');
		$addons.each(function(i, obj) {
			$addonQty = parseInt(obj.value);
			$addonName = obj.getAttribute('name');
			if ($addonQty > 0) {
				$selectedAddons.push({name: $addonName, qty: $addonQty});
			}
		});
		return $selectedAddons;
	};
	// A reference to Stripe.js initialized with your real test publishable API key.
	var stripe = Stripe("<?php echo $jConfig->get('stripe_publishable_key'); ?>");

	// Disable the button until we have Stripe set up on the page
	document.querySelector("button").disabled = true;

	var elements = stripe.elements();
	var style = {
		base: {
			color: "#32325d",
			fontFamily: 'Arial, sans-serif',
			fontSmoothing: "antialiased",
			fontSize: "16px",
			"::placeholder": {
				color: "#32325d"
			}
		},
		invalid: {
			fontFamily: 'Arial, sans-serif',
			color: "#fa755a",
			iconColor: "#fa755a"
		}
	};
	var card = elements.create("card", {
		style: style
	});
	// Stripe injects an iframe into the DOM
	card.mount("#card-element");
	card.on("change", function(event) {
		// Disable the Pay button if there are no card details in the Element
		document.querySelector("button").disabled = event.empty;
		document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
	});
	var form = document.getElementById("payment-form");
	form.addEventListener("submit", function(event) {
		event.preventDefault();

		// Calls stripe.confirmCardPayment
		// If the card requires authentication Stripe shows a pop-up modal to
		// prompt the user to enter authentication details without leaving your page.
		var payWithCard = function(stripe, card, clientSecret) {
			loading(true);
			stripe
				.confirmCardPayment(clientSecret, {
					payment_method: {
						card: card
					}
				})
				.then(function(result) {
					if (result.error) {
						// Show error to your customer
						showError(result.error.message);
					} else {
						// The payment succeeded!
						orderComplete(result.paymentIntent.id);
					}
				});
		};
		/* ------- UI helpers ------- */
		// Shows a success message when the payment is complete
		var orderComplete = function(paymentIntentId) {
			loading(false);
			document
				.querySelector(".result-message a")
				.setAttribute(
					"href",
					"https://dashboard.stripe.com/test/payments/" + paymentIntentId
				);
			document.querySelector(".result-message").classList.remove("hidden");
			document.querySelector("button").disabled = true;
		};
		// Show the customer the error from Stripe if their card fails to charge
		var showError = function(errorMsgText) {
			loading(false);
			var errorMsg = document.querySelector("#card-error");
			errorMsg.textContent = errorMsgText;
			setTimeout(function() {
				errorMsg.textContent = "";
			}, 4000);
		};
		// Show a spinner on payment submission
		var loading = function(isLoading) {
			if (isLoading) {
				// Disable the button and show a spinner
				document.querySelector("button").disabled = true;
				document.querySelector("#spinner").classList.remove("hidden");
				document.querySelector("#button-text").classList.add("hidden");
			} else {
				document.querySelector("button").disabled = false;
				document.querySelector("#spinner").classList.add("hidden");
				document.querySelector("#button-text").classList.remove("hidden");
			}
		};
		var addons = generateAddonList();

		fetch("<?php echo JRoute::_('index.php??option=com_swa&task=ticketpurchase.submit') ?>", {
				method: "POST",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({addons: addons})
			})
			.then(function(result) {
				console.log(result.text());
				return result.json();
			})
			.then(function(data) {
				// Complete payment when the submit button is clicked
				payWithCard(stripe, card, data.clientSecret);
			});
	});
</script>


<!-- <button class="btn btn-primary btn-lg" id="stripe-button">
	<span class="glyphicon glyphicon-shopping-cart">
		<?php echo "Pay £{$ticket->price} now!" ?>
	</span>
</button> -->

<!-- <script>
		var handler = StripeCheckout.configure({
			key: "<?php echo $jConfig->get('stripe_publishable_key'); ?>",
			image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
			locale: 'auto',
			email: "<?php echo $this->user->email ?>",
			token: function (res) {
				jQuery('#stripeToken').val(res.id);
				jQuery('#stripe-form').submit();
			}
		});

        document.getElementById('stripe-button').addEventListener('click', function (e) {
            // Get ticket amount
            var amount = parseInt(jQuery("#stripe-button").attr('data-amount'));

            if ( amount > 0 ) {
	            // Open Checkout with further options:
	            handler.open({
	                name: 'SWA',
	                description: "<?php echo "{$ticket->event_name} - {$ticket->ticket_name}" ?>",
	                currency: 'GBP',
	                zipCode: true,
	                amount: amount
	            });
	            e.preventDefault();

                // Close Checkout on page navigation:
                window.addEventListener('popstate', function () {
                    handler.close();
                });
            } else {
                document.getElementById('stripe-button').addEventListener('click', function (e) {
                    jQuery('#stripe-form').submit();
                })
            }
        });

</script> -->