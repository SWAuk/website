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
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$jConfig = JFactory::getConfig();
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_swa/assets/css/stripe_style.css');

?>

<h1>Membership Payment</h1>

<script src="https://js.stripe.com/v3/"></script>
<form id="payment-form" method="POST" enctype="multipart/form-data">
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
		Processing order, please do not navigate away from this page...
	</p>
	<h2 id="payment-total">Total: 5 GBP</h2>
</form>


<!-- handle payment -->
<script type="text/javascript">
	// A reference to Stripe.js initialized with your real test publishable API key.
	var stripe = Stripe("<?php echo $jConfig->get('stripe_publishable_key'); ?>");
	var stripButtonPermanentDisable = false;

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
		// Disable the Pay button if there are no card details in the Element
		document.querySelector("#stripe-button").disabled = event.empty || stripButtonPermanentDisable;
		document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
	});

	fetch("<?php echo JRoute::_('index.php??option=com_swa&task=memberpayment.createPaymentIntent') ?>")
		.then(function(result) {
			if (result.ok) {
				return result.json().then(function(response) {
					console.log(response)
					if (response.messages) {
						Joomla.renderMessages(response.messages);
					}
					if (response.success) {
						var form = document.getElementById("payment-form");
						form.addEventListener("submit", function(event) {
							event.preventDefault();
							// Complete payment when the submit button is clicked
							payWithCard(stripe, card, response.data.clientSecret);
						});
					} else {
						showError(response.message);
						console.error(response.message);
						stripButtonPermanentDisable = true;
						document.querySelector("#stripe-button").disabled = true;
					}
				})
			} else {
				stripButtonPermanentDisable = true
				document.querySelector("#stripe-button").disabled = true;
				return result.text().then(text => {
					Joomla.renderMessages({"error": [text]
					});
				})
			}
		});

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
		fetch("<?php echo JRoute::_('index.php??option=com_swa&task=memberpayment.setMemberPaid') ?>", {
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
							window.location.href = "<?php echo JRoute::_('index.php?option=com_swa') ?>";
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
						stripButtonPermanentDisable = false;
						document.querySelector("#stripe-button").disabled = true;
						Joomla.renderMessages({"error": [text]});
						msg = "Order Failed. You may have lost connection. \n\r Please contact webmaster@swa.co.uk "
						msg += "if your bank shows you have been charged for this transaction. Otherwise, please try again."
						Joomla.renderMessages({"error": [msg]});
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
</script>

<p>Note: If you have been redirected here after already paying try refreshing.</p>
<p>If the problem continues please email webmaster@swa.co.uk.</p>
