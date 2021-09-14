<?php
/*
This payment process is based off the 'Custom Payment Flow' at the following stipe site.
https://stripe.com/docs/payments/accept-a-payment?integration=elements

A tutorial is available here (at the time of writing):
https://stripe.com/docs/payments/integration-builder
*/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.framework', true);

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);

$jConfig = JFactory::getConfig();
$app     = JFactory::getApplication();
$document = JFactory::getDocument();
$ticket  = null;

$ticketId = $app->input->getString('ticketId');

$document->addStyleSheet('components/com_swa/assets/css/stripe_style.css');

foreach ($this->items as $item) {
	if ($item->id == $ticketId) {
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
	var stripButtonPermanentDisable = false;
	var paymentRequest;
	jQuery(document).ready(function() {
		$validAddon = true;
		$cardDetailsComplete = false;
		$stripeCardErrorMsg = ""
		$totalDiv = document.getElementById("payment-total");
		$addons = jQuery('.swa-addon');
		initialiseMobilePayment();
		// define function to enable/disable stripe button
		setStripeButtonStatus = function() {
			if (stripButtonPermanentDisable) {
				document.querySelector("#stripe-button").disabled = true;
			} else if (!$validAddon) {
				document.querySelector("#stripe-button").disabled = true;
				$ErrorMsg = "Invalid addon selection";
			} else if (!$cardDetailsComplete) {
				document.querySelector("#stripe-button").disabled = true;
				$ErrorMsg = $stripeCardErrorMsg;
			} else {
				document.querySelector("#stripe-button").disabled = false;
				$ErrorMsg = ""
			}
			document.querySelector("#card-error").textContent = $ErrorMsg;
		}

		// define function to calculate the total ticket price and display it
		$updateTicketPrice = function() {
			$ticketPrice = parseFloat(jQuery(".swa-ticket").attr('data-price'));
			$addonsArray = $generateAddonsArray()

			$totalAddonsPrice = 0;
			$addonsArray.forEach(function(addon) {
				$addonQty = addon.qty;
				if ($addonQty > 0) {
					$addonPrice = addon.price;
					$totalAddonsPrice += $addonPrice * $addonQty
				}
			});

			$totalPrice = $ticketPrice + $totalAddonsPrice;
			// stripe amount is in pence
			$totalDiv.innerHTML = "Total: " + $totalPrice.toFixed(2) + " GBP";
			updateMobilePaymentButtonCost($totalPrice);

		};

		// define function to determine if addon seletion is valid
		$determineValidAddon = function() {
			$validAddon = true;
			if ($addons.length < 1) {
				return
			}

			$qtySelectors.each(function(i, obj) {
				$value = obj.value;
				if ($value > 0) {
					if (jQuery('#select_' + obj.getAttribute('data-id')).val() == "NULL") {
						$validAddon = false;
						// break out of the .each loop
						return;
					}
				} else if ($value == "NULL") {
					$validAddon = false;
					// break out of the .each loop
					return;
				}
			});
		};

		$generateAddonsArray = function() {
			$selectedAddons = [];
			$addons = jQuery('.swa-addon');
			$addons.each(function(i, obj) {
				$addonQty = parseInt(obj.value);
				$addonId = obj.getAttribute('data-id');
				if ($addonQty > 0) {
					$selectedAddons[$addonId] = [];
					$selectedAddons[$addonId] = {
						id: obj.getAttribute('data-id'),
						name: obj.getAttribute('data-name'),
						qty: $addonQty,
						option: jQuery('#select_' + obj.getAttribute('data-id')).val(),
						price: parseFloat(obj.getAttribute('data-price')) // not used as final amount to charge customer as could be tampered with malicipoiusly
					};
				}
			});
			return $selectedAddons;
		}

		if ($addons.length > 0) {
			$qtySelectors = jQuery('.swa-qty-selector');
			$optionSelectors = jQuery('.swa-option-selector');

			// disable and hide all option selectors
			$optionSelectors.prop('disabled', true);
			$optionSelectors.parent().prop('hidden', true);

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
			};

			$qtySelectors.change(function(event) {
				$qtyChanged(event);
				$updateTicketPrice();
				$determineValidAddon(event)
				setStripeButtonStatus();
			});

			$optionSelectors.change(function(event) {
				$determineValidAddon(event);
				setStripeButtonStatus();
			});
		}

		$updateTicketPrice();
	});
</script>


<!-- create form -->
<script src="https://js.stripe.com/v3/"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<!-- handle payment -->

<h1>Order Summary</h1>

<form id="payment-form" method="POST" enctype="multipart/form-data">

	<div class="table-responsive favth-table-responsive">
		<jdoc:include type="message" />
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
							<select 
							id="<?php echo "addon_{$key}" ?>" 
							name="<?php echo "addons[{$key}][qty]" ?>" 
							data-id="<?php echo $key ?>" 
							class="swa-addon swa-qty-selector" 
							style="width: 60px" 
							data-price="<?php echo $addon->price ?>" 
							data-name="<?php echo $addon->name ?>">
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
									<select 
									id="<?php echo "select_{$key}" ?>" 
									name="<?php echo "addons[{$key}][option]" ?>" 
									data-id="<?php echo $key ?>" 
									class="swa-option-selector" data-price="<?php echo $option->price ?>">
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
	<h2 id="payment-total">Total: GBP</h2>
	<div id="card-element">
		<!--Stripe.js injects the Card Element-->
	</div>

	<button id="stripe-button">
		<div class="spinner hidden" id="spinner"></div>
		<span id="button-text">Pay</span>
	</button>
	<hr>
	<div id="payment-request-button">
		<!-- A Stripe Element will be inserted here. -->
	</div>

	<p id="card-error" role="alert"></p>
	<p class="result-message hidden">
		Processing order, please do not navigate away from this page...
	</p>
</form>


<script type="text/javascript">
	// A reference to Stripe.js initialized with the publishable API key loaded from the Joomla configuration.php file.

	var stripe = Stripe("<?php echo $jConfig->get('stripe_publishable_key'); ?>");

	// Disable the button until we have Stripe set up on the page
	document.querySelector("#stripe-button").disabled = true;

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
		// Disable the Pay button if there are no card details in the Element or add on not valid
		$stripeCardErrorMsg = event.error ? event.error.message : "";
		$cardDetailsComplete = event.complete;
		setStripeButtonStatus();
	});
	var form = document.getElementById("payment-form");



	//start mobile payment
	var updateMobilePaymentButtonCost = function(paymentPrice) {
		paymentRequest.update({
			total: {
				label: '<?php echo "{$ticket->event_name} - {$ticket->ticket_name}" ?>',
				amount: paymentPrice * 100
			},
		});
	}

	var initialiseMobilePayment = function() {

		var basePrice = parseFloat(jQuery(".swa-ticket").attr('data-price'));

		paymentRequest = stripe.paymentRequest({
			country: 'GB',
			currency: 'gbp',
			total: {
				label: '<?php echo "{$ticket->event_name} - {$ticket->ticket_name}" ?>',
				amount: basePrice * 100
			},
		});


		var prButton = elements.create('paymentRequestButton', {
			paymentRequest: paymentRequest,
		});

		paymentRequest.canMakePayment().then(function(result) {
			if (result) {
				prButton.mount('#payment-request-button');
			} else {
				document.getElementById('payment-request-button').style.display = 'none';
			}
		});

		//on apple/google pay complete
		paymentRequest.on('paymentmethod', function(ev) {
			loading(true)
			event.preventDefault();

			var addons = $generateAddonsArray();
			fetch("<?php echo JRoute::_('index.php??option=com_swa&task=ticketpurchase.createPaymentIntent') ?>", {
					method: "POST",
					headers: {
						"Content-Type": "application/json"
					},
					body: JSON.stringify({
						ticketId: "<?php echo $ticketId ?>",
						addons: addons,
						estimatedPrice: $totalPrice,
						paymentMethod: "card",
						currency: "gbp"
					})
				})
				.then(function(result) {
					if (result.ok) {
						return result.json().then(function(response) {
							// console.log(response)
							if (response.messages) {
								Joomla.renderMessages(response.messages);
							}
							if (response.success) {
								stripe.confirmCardPayment(response.data.clientSecret, {
									payment_method: ev.paymentMethod.id
								}, {
									handleActions: false
								}).then(function(
									result //https://stripe.com/docs/js/payment_intents/confirm_card_payment
								) {
									if (result.error) {
										ev.complete("fail");
										showError(result.error);
										return;
									}
									let paymentIntent = result.paymentIntent;
									ev.complete('success');
									if (paymentIntent.status == "requires_action") {
										//recomplete with actions after closing payment modal (ev - apple pay sheet)
										stripe.confirmCardPayment(response.data.clientSecret).then(function(result) {
											if (result.error) {
												ev.complete("fail");
												showError(result.error);
												return;
											}
										});
									}
									processOrder(paymentIntent.id);
								});

							} else {
								ev.complete("fail");
								showError(response.message);
								// console.error(response.message);
							}
						})
					} else {
						ev.complete("fail");
						return result.text().then(text => {
							Joomla.renderMessages({
								"error": [text]
							});
						})
					}
				});
		});
	}
	//end mobile payment

	var payWithCard = function(stripe, card, clientSecret) {
		// console.log(stripe, card, clientSecret)
		loading(true);
		stripe
			.confirmCardPayment(clientSecret, {
				payment_method: {
					card: card
				}
			})
			.then(function(result) {
				// console.log(result)
				if (result.error) {
					// Show error to your customer
					showError(result.error.message);
				} else {
					// The payment succeeded!
					processOrder(result.paymentIntent.id);
				}
			});
	};






	/* ------- UI helpers ------- */
	// Shows a success message when the payment is complete
	var processOrder = function(paymentIntentId) {
		loading(true);
		document.querySelector(".result-message").classList.remove("hidden");
		document.querySelector("#stripe-button").disabled = true;
		fetch("<?php echo JRoute::_('index.php??option=com_swa&task=ticketpurchase.addTicketToDb') ?>", {
				method: "POST",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({
					paymentIntentId: paymentIntentId,
				})
			})
			.then(function(result) {
				if (result.ok) {
					return result.json().then(function(response) {
						console.log(response)
						if (response.messages) {
							Joomla.renderMessages(response.messages);
						}
						if (response.success) {
							window.location.href = "<?php echo JRoute::_('index.php?option=com_swa&view=membertickets') ?>";
						} else {
							showError(response.message);
							console.error(response.message);
							document.querySelector(".result-message").classList.add("hidden");
							stripButtonPermanentDisable = true;
							document.querySelector("#stripe-button").disabled = true;
						}
					})
				} else {
					return result.text().then(text => {
						stripButtonPermanentDisable = true;
						document.querySelector("#stripe-button").disabled = true;
						Joomla.renderMessages({
							"error": [text]
						});
						msg = "Oops! You may have lost connection. \n\r Please check Account>My Tickets to see if the order went through. \r\n"
						msg += "If it did not go through and you have still been charged, please contact <a href='mailto:webmaster@swa.co.uk'>webmaster@swa.co.uk</a> to resolve this"
						Joomla.renderMessages({
							"error": [msg]
						});
					})
				}
			});
	};


	// Show the customer the error from Stripe if their card fails to charge
	var showError = function(errorMsgText) {
		loading(false);
		var errorMsg = document.querySelector("#card-error");
		errorMsg.textContent = errorMsgText;
		setTimeout(function() {
			errorMsg.textContent = "";
		}, 7000);
	};


	// Show a spinner on payment submission
	var loading = function(isLoading) {
		if (isLoading) {
			// Disable the button and show a spinner
			document.querySelector("#stripe-button").disabled = true;
			document.querySelector("#spinner").classList.remove("hidden");
			document.querySelector("#button-text").classList.add("hidden");
		} else {
			document.querySelector("#stripe-button").disabled = false;
			document.querySelector("#spinner").classList.add("hidden");
			document.querySelector("#button-text").classList.remove("hidden");
		}
	};

	// Complete payment when the submit button is clicked
	form.addEventListener("submit", function(event) {
		loading(true)
		event.preventDefault();

		var addons = $generateAddonsArray();

		fetch("<?php echo JRoute::_('index.php??option=com_swa&task=ticketpurchase.createPaymentIntent') ?>", {
				method: "POST",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({
					ticketId: "<?php echo $ticketId ?>",
					addons: addons,
					estimatedPrice: $totalPrice
				})
			})
			.then(function(result) {
				if (result.ok) {
					return result.json().then(function(response) {
						console.log(response)
						if (response.messages) {
							Joomla.renderMessages(response.messages);
						}
						if (response.success) {
							payWithCard(stripe, card, response.data.clientSecret);
						} else {
							showError(response.message);
							console.error(response.message);
						}
					})
				} else {
					return result.text().then(text => {
						Joomla.renderMessages({
							"error": [text]
						});
					})
				}
			});
	});
</script>
