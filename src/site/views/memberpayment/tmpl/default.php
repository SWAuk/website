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
<form id="payment-form" data-secret="" method="POST" enctype="multipart/form-data">

	<div id="payment-element">
		<!-- Elements will create form elements here -->
	</div>


	<div id="error-message">
		<!-- Display error message to your customers here -->
	</div>

	<p class="result-message hidden">
		Processing order, please do not navigate away from this page...
	</p>
	<div style="margin-top: 4rem">
					<button class="stripe-button" disabled="true" id="stripe-button">
						<div class="spinner hidden" id="spinner"></div>
						<span id="payment-button-text">Pay</span>
					</button>
		</div>

		<h2 id="payment-total">Total: 5 GBP</h2>
</form>


<!-- handle payment -->
<script type="text/javascript">
	// A reference to Stripe.js initialized with your real test publishable API key.
	var stripe = Stripe("<?php echo $jConfig->get('stripe_publishable_key'); ?>");
	var stripButtonPermanentDisable = false;
	var paymentRequest;
	var intent;
	var payment_result;
	var elements;
	var response;

	jQuery(window).on('load', async function () {
		//This is slightly different as the endpoint is different.
		async function createPaymentIntent() {
			const response = await fetch("<?php echo JRoute::_('index.php?option=com_swa&task=memberpayment.createPaymentIntent') ?>");
			return response;
		}

		// Disable the button until we have Stripe set up on the page
		intent = await createPaymentIntent();
		//update intent here
		if (intent.ok) {
			response = await intent.json();
			if (response.messages) {
				Joomla.renderMessages(response.messages);
			}
			if (response.success) {
				///loading in checkout
				const options = {
					clientSecret: response.data.clientSecret, //todo add extra error reporting
					// Fully customizable with appearance API.
					appearance: {/*...*/},
				};

				// Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 2
				elements = stripe.elements(options);

				// Create and mount the Payment Element
				const paymentElement = elements.create('payment');
				paymentElement.mount('#payment-element');
				document.querySelector("#stripe-button").disabled = false;
			} else {
				showError(response.message);
				console.error(response.message);
			}
		} else {
			console.log("intent is not okay");
			var text = await intent.text();
			Joomla.renderMessages({
				"error": [text]
			});
		}


		var pay_order = document.getElementById("stripe-button")
		// Complete payment when the stripe-button button is clicked
		pay_order.addEventListener("click", async function (event) {
			loading(true)
			event.preventDefault();
			//actually perform the payment
			const {error} = await stripe.confirmPayment({
				//`Elements` instance that was used to create the Payment Element
				elements,
				confirmParams: {return_url: 'https://swa.co.uk',}, redirect: 'if_required'
			});

			if (error) {
				// This point will only be reached if there is an immediate error when
				// confirming the payment. Show error to your customer (for example, payment
				// details incomplete)
				showError(error.message);
			} else {
				processOrder("<?php echo JRoute::_('index.php??option=com_swa&task=memberpayment.setMemberPaid') ?>",
					"<?php echo JRoute::_('index.php?option=com_swa') ?>",
					response.data.intentId);
			}

		});


		var processOrder = async function (action, redirect_route, paymentIntentId) {
			loading(true);
			document.querySelector(".result-message").classList.remove("hidden");
			document.querySelector("#stripe-button").disabled = true;
			var result = await fetch(action, {
				method: "POST",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({
					paymentIntentId: paymentIntentId,
				})
			});
			if (result.ok) {
				var response = await result.json();
				if (response.messages) {
					Joomla.renderMessages(response.messages);
				}
				if (response.success) {
					window.location.href = redirect_route;
				} else {
					showError(response.message);
					console.error(response.message);
					document.querySelector(".result-message").classList.add("hidden");
					stripButtonPermanentDisable = true;
					document.querySelector("#stripe-button").disabled = true;

				}
			} else {
				var text = await result.text();
				stripButtonPermanentDisable = true;
				document.querySelector("#stripe-button").disabled = true;
				Joomla.renderMessages({
					"error": [text]
				});
				msg = "Oops! You may have lost connection. \n\r Please check Account>My Tickets to see if the order went through. \r\n"
				msg += "If it did not go through, and you have still been charged, please contact <a href='mailto:webmaster@swa.co.uk'>webmaster@swa.co.uk</a> to resolve this"
				Joomla.renderMessages({
					"error": [msg]
				});
			}
		};

		// Show the customer the error from Stripe if their card fails to charge
		var showError = function (errorMsgText) {
			loading(false);
			var errorMsg = document.querySelector("#error-message");
			errorMsg.textContent = errorMsgText;
			setTimeout(function () {
				errorMsg.textContent = "";
			}, 4000);
		};
		// Show a spinner on payment submission
		var loading = function (isLoading) {
			if (isLoading) {
				// Disable the button and show a spinner
				document.querySelector("#stripe-button").disabled = true;
				document.querySelector("#spinner").classList.remove("hidden");
				document.querySelector("#payment-button-text").classList.add("hidden");
			} else {
				document.querySelector("#stripe-button").disabled = false;
				document.querySelector("#spinner").classList.add("hidden");
				document.querySelector("#payment-button-text").classList.remove("hidden");
			}
		};
	});
</script>

<p>Note: If you have been redirected here after already paying try refreshing.</p>
<p>If the problem continues please email <a href='mailto:webmaster@swa.co.uk'>webmaster@swa.co.uk</a>.</p>
