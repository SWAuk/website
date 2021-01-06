<?php

defined('_JEXEC') or die;

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

	// Disable the button until we have Stripe set up on the page
	document.querySelector("#stripe-button").disabled = true;

	fetch("<?php echo JRoute::_('index.php??option=com_swa&task=memberpayment.createPaymentIntent') ?>")
		.then(function(result) {
			return result.json();
		})
		.then(function(data) {
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
				document.querySelector("#stripe-button").disabled = event.empty;
				document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
			});
			var form = document.getElementById("payment-form");
			form.addEventListener("submit", function(event) {
				event.preventDefault();
				// Complete payment when the submit button is clicked
				payWithCard(stripe, card, data.clientSecret);
			});
		})
		.catch(function(error) {
			// Handle the error
			error_text = error.message
			error_json = JSON.parse(error_text)
			showError(error_json.error);
			console.error(error_json.error);
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
					window.location.href = "<?php echo JRoute::_('index.php?option=com_swa') ?>";
				} else {
					return result.text().then(text => {
						throw new Error(text)
					})
				}
			})
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