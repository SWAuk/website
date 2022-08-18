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
$app = JFactory::getApplication();
$document = JFactory::getDocument();
$app = JFactory::getApplication();
$user = JFactory::getUser();
$db = JFactory::getDbo();
$valid_agreement = $db->getQuery(true);
$valid_agreement
    ->select('agr.*')
    ->from($db->quoteName('#__swa_member', 'smem'))
    ->join('INNER', $db->quoteName('#__swa_university_member', 'suni')
				. " ON " . $db->quoteName('smem.id') . ' = ' . $db->quoteName('suni.member_id') . ' AND ' . $db->quoteName('smem.university_id') .
				' = ' . $db->quoteName('suni.university_id'))
    ->join('INNER', $db->quoteName('#__university_agreements', 'agr') . " ON " .
				$db->quoteName('smem.university_id') . ' = ' . $db->quoteName('agr.university_id')
		)
    ->where($db->quoteName('smem.user_id') . ' = ' . $db->quote($user->id));

$db->setQuery($valid_agreement);
$results = $db->loadObject();
// Check if valid agreement
$valid = false;
if (is_null($results)){
	$valid = false;
}
elseif ($results->override == 1) {
	$valid = true;
}
elseif ($results->signed == 1 && $results->date != null) {
	if (strtotime($results->date) > strtotime('-1 year')) {
		// If valid agreement
		$valid = true;
	}
}


$ticket = null;
$ticketId = $app->input->getString('ticketId');

$document->addStyleSheet('components/com_swa/assets/css/stripe_style.css');
$document->addStyleSheet('components/com_swa/assets/css/simple_grid.css');

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
	elseif (!$valid){
	$app->redirect(JRoute::_('index.php?option=com_swa&view=ticketpurchase'));
}
?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
	var stripButtonPermanentDisable = false;
	var paymentRequest;
	jQuery(document).ready(function () {
		$validAddon = true;
		$cardDetailsComplete = false;
		$stripeCardErrorMsg = ""
		$totalDiv = document.getElementById("payment-total");
		$addons = jQuery('.swa-addon');
		// define function to enable/disable stripe button

		// define function to calculate the total ticket price and display it
		$updateTicketPrice = function () {
			$ticketPrice = parseFloat(jQuery(".swa-ticket").attr('data-price'));
			$addonsArray = $generateAddonsArray()

			$totalAddonsPrice = 0;
			$addonsArray.forEach(function (addon) {
				$addonQty = addon.qty;
				if ($addonQty > 0) {
					$addonPrice = addon.price;
					$totalAddonsPrice += $addonPrice * $addonQty
				}
			});

			$totalPrice = $ticketPrice + $totalAddonsPrice;
			// stripe amount is in pence
			$totalDiv.innerHTML = "Total: " + $totalPrice.toFixed(2) + " GBP";
			document.getElementById("payment-button-text").innerHTML = "Pay £" + $totalPrice.toFixed(2);

			// updateMobilePaymentButtonCost($totalPrice);
		};
		// define function to determine if addon seletion is valid
		$determineValidAddon = function () {
			$validAddon = true;
			if ($addons.length < 1) {
				return
			}

			$qtySelectors.each(function (i, obj) {
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
		$generateAddonsArray = function () {
			$selectedAddons = [];
			$addons = jQuery('.swa-addon');
			$addons.each(function (i, obj) {
				$addonQty = parseInt(obj.value);
				$addonId = obj.getAttribute('data-id');
				if ($addonQty > 0) {
					$selectedAddons[$addonId] = [];
					$selectedAddons[$addonId] = {
						id: obj.getAttribute('data-id'),
						name: obj.getAttribute('data-name'),
						qty: $addonQty,
						option: jQuery('#select_' + obj.getAttribute('data-id')).val(),
						price: parseFloat(obj.getAttribute('data-price')) // not used as final amount to charge customer as could be tampered with maliciously
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
			$qtyChanged = function (event) {
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

			$qtySelectors.change(function (event) {
				$qtyChanged(event);
				$updateTicketPrice();
				$determineValidAddon(event);
			});

			$optionSelectors.change(function (event) {
				$determineValidAddon(event);
			});
		}

		$updateTicketPrice();

	});
</script>


<!-- create form -->
<script src="https://js.stripe.com/v3/"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<!-- handle payment -->

<script>
	/**
	 * Define a function to navigate betweens form steps.
	 * It accepts one parameter. That is - step number.
	 */
	const navigateToFormStep = (stepNumber) => {
		/**
		 * Hide all form steps.
		 */
		document.querySelectorAll(".form-step").forEach((formStepElement) => {
			formStepElement.classList.add("d-none");
		});
		/**
		 * Mark all form steps as unfinished.
		 */
		document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
			formStepHeader.classList.add("form-stepper-unfinished");
			formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
		});
		/**
		 * Show the current form step (as passed to the function).
		 */
		document.querySelector("#step-" + stepNumber).classList.remove("d-none");
		/**
		 * Select the form step circle (progress bar).
		 */
		const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
		/**
		 * Mark the current form step as active.
		 */
		formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
		formStepCircle.classList.add("form-stepper-active");
		/**
		 * Loop through each form step circles.
		 * This loop will continue up to the current step number.
		 * Example: If the current step is 3,
		 * then the loop will perform operations for step 1 and 2.
		 */
		for (let index = 0; index < stepNumber; index++) {
			/**
			 * Select the form step circle (progress bar).
			 */
			const formStepCircle = document.querySelector('li[step="' + index + '"]');
			/**
			 * Check if the element exist. If yes, then proceed.
			 */
			if (formStepCircle) {
				/**
				 * Mark the form step as completed.
				 */
				formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
				formStepCircle.classList.add("form-stepper-completed");
			}
		}
	};
</script>

<style>

	.loader {
		margin: 100px auto 0;
		width: 70px;
		text-align: center;
		align-self: center;
		margin-left: 48.5%;
	}

	.loader > div {
		width: 18px;
		height: 18px;
		background-color: #1271b0;

		border-radius: 100%;
		display: inline-block;
		-webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
		animation: sk-bouncedelay 1.4s infinite ease-in-out both;
	}

	.loader .bounce1 {
		-webkit-animation-delay: -0.32s;
		animation-delay: -0.32s;
	}

	.loader .bounce2 {
		-webkit-animation-delay: -0.16s;
		animation-delay: -0.16s;
	}

	@-webkit-keyframes sk-bouncedelay {
		0%, 80%, 100% {
			-webkit-transform: scale(0)
		}
		40% {
			-webkit-transform: scale(1.0)
		}
	}

	@keyframes sk-bouncedelay {
		0%, 80%, 100% {
			-webkit-transform: scale(0);
			transform: scale(0);
		}
		40% {
			-webkit-transform: scale(1.0);
			transform: scale(1.0);
		}
	}

	h1 {
		text-align: center;
	}

	h2 {
		margin: 0;
	}

	#multi-step-form-container {
		margin-top: 5rem;
	}

	.text-center {
		text-align: center;
	}

	.mx-auto {
		margin-left: auto;
		margin-right: auto;
	}

	.pl-0 {
		padding-left: 0;
	}

	.button {
		padding: 0.7rem 1.5rem;
		border: 1px solid #1271b0;
		background-color: #1271b0;
		color: #fff;
		border-radius: 5px;
		cursor: pointer;
	}

	.stripe-button-btn {
		border: 1px solid #1271b0;
		background-color: #1271b0;
	}

	.mt-3 {
		margin-top: 2rem;
	}

	.d-none {
		display: none;
	}

	.form-step {
		border: 1px solid rgba(0, 0, 0, 0.1);
		border-radius: 20px;
		padding: 3rem;
	}

	.font-normal {
		font-weight: normal;
	}

	ul.form-stepper {
		counter-reset: section;
		margin-bottom: 3rem;
	}

	ul.form-stepper .form-stepper-circle {
		position: relative;
	}

	ul.form-stepper .form-stepper-circle span {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translateY(-50%) translateX(-50%);
	}

	.form-stepper-horizontal {
		position: relative;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		justify-content: space-between;
	}

	ul.form-stepper > li:not(:last-of-type) {
		margin-bottom: 0.625rem;
		-webkit-transition: margin-bottom 0.4s;
		-o-transition: margin-bottom 0.4s;
		transition: margin-bottom 0.4s;
	}

	.form-stepper-horizontal > li:not(:last-of-type) {
		margin-bottom: 0 !important;
	}

	.form-stepper-horizontal li {
		position: relative;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-flex: 1;
		-ms-flex: 1;
		flex: 1;
		-webkit-box-align: start;
		-ms-flex-align: start;
		align-items: start;
		-webkit-transition: 0.5s;
		transition: 0.5s;
	}

	.form-stepper-horizontal li:not(:last-child):after {
		position: relative;
		-webkit-box-flex: 1;
		-ms-flex: 1;
		flex: 1;
		height: 1px;
		content: "";
		top: 32%;
	}

	.form-stepper-horizontal li:after {
		background-color: #dee2e6;
	}

	.form-stepper-horizontal li.form-stepper-completed:after {
		background-color: #1271b0;
	}

	.form-stepper-horizontal li:last-child {
		flex: unset;
	}

	ul.form-stepper li a .form-stepper-circle {
		display: inline-block;
		width: 40px;
		height: 40px;
		margin-right: 0;
		line-height: 1.7rem;
		text-align: center;
		background: rgba(0, 0, 0, 0.38);
		border-radius: 50%;
	}

	.form-stepper .form-stepper-active .form-stepper-circle {
		background-color: #0c7edc !important;
		color: #fff;
	}

	.form-stepper .form-stepper-active .label {
		color: black !important;
	}

	.form-stepper .form-stepper-active .form-stepper-circle:hover {
		background-color: #22a8ff !important;
		color: #fff !important;
	}

	.form-stepper .form-stepper-unfinished .form-stepper-circle {
		background-color: #6bc2fc;
	}

	.form-stepper .form-stepper-completed .form-stepper-circle {
		background-color: #1271b0 !important;
		color: #fff;
	}

	/*.form-stepper .form-stepper-completed .label {*/
	/*	color: grey !important;*/
	/*}*/
	.form-stepper .form-stepper-completed .form-stepper-circle:hover {
		background-color: #1271b0 !important;
		color: #fff !important;
	}

	.form-stepper .form-stepper-active span.text-muted {
		color: #fff !important;
	}

	.form-stepper .form-stepper-completed span.text-muted {
		color: #fff !important;
	}

	.form-stepper .label {
		font-size: 1rem;
		margin-top: 0.5rem;
	}

	.form-stepper a {
		cursor: default;
	}

</style>

<div>
	<h1 style="text-align: left">Checkout</h1>
	<div id="multi-step-form-container">
		<!-- Form Steps / Progress Bar -->
		<ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
			<!-- Step 1 -->
			<li class="form-stepper-active text-center form-stepper-list" step="1">
				<a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>1</span>
                    </span>
					<div>Confirm Order</div>
				</a>
			</li>
			<!-- Step 2 -->
			<li class="form-stepper-unfinished text-center form-stepper-list" step="2">
				<a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>2</span>
                    </span>
					<div>Order Validation</div>
				</a>
			</li>
			<!-- Step 3 -->
			<li class="form-stepper-unfinished text-center form-stepper-list" step="3">
				<a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>3</span>
                    </span>
					<div>Payment</div>
				</a>
			</li>
		</ul>
		<!-- Step Wise Form Content -->
		<form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
			<!-- Step 1 Content -->
			<section id="step-1" class="form-step">
				<h4>Order Summary</h4>

				<div class="table-responsive favth-table-responsive">
					<jdoc:include type="message"/>
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
										<select id="<?php echo "addon_{$key}" ?>"
												name="<?php echo "addons[{$key}][qty]" ?>"
												data-id="<?php echo $key ?>"
												class="swa-addon swa-qty-selector" style="width: 60px"
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
												<select id="<?php echo "select_{$key}" ?>"
														name="<?php echo "addons[{$key}][option]" ?>"
														data-id="<?php echo $key ?>"
														class="swa-option-selector"
														data-price="<?php echo $option->price ?>">
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

				<h2 style="display: flex; justify-content: flex-end" id="payment-total">Total: GBP</h2>


				<div style="display: flex; justify-content: flex-end" class="mt-3">
					<button id="confirm-order-button" class="button btn-navigate-form-step" type="button"
							step_number="2">Next
					</button>
				</div>
			</section>
			<!-- Step 2 Content, default hidden on page load. -->
			<section id="step-2" class="d-none">
				<div id="loader" class="loader">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
			</section>
			<!-- Step 3 Content, default hidden on page load. -->
			<section id="step-3" class="form-step d-none">
				<!--STRIPE PAYMENT DOM-->
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
				</form>
				<!--END STRIPE PAYMENT DOM-->


				<div class="mt-3">
					<div class="" style="display: flex; justify-content: flex-end">
						<div style="position: sticky; right: 4rem">
							<div style="display: inline-block; margin: 6px;">
								<button id="edit_order_button" class="stripe-button" step_number="1">
									Cancel
								</button>
							</div>
							<div style="display: inline-block; margin: 6px">
								<button class="stripe-button" id="stripe-button">
									<div class="spinner hidden" id="spinner"></div>
									<span id="payment-button-text">Pay</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</form>
	</div>
</div>

<!-- PAYMENT UTILS -->
<script type="text/javascript">
	// A reference to Stripe.js initialized with the publishable API key loaded from the Joomla configuration.php file.
	var stripe = Stripe("<?php echo $jConfig->get('stripe_publishable_key'); ?>");
	var form = document.getElementById("payment-form");
	var confirm_order = document.getElementById("confirm-order-button");
	var edit_order = document.getElementById("edit_order_button");
	var pay_order = document.getElementById("stripe-button");

	var processOrder = async function (action, redirect_route, paymentIntentId) {
		loading(true);
		document.querySelector(".result-message").classList.remove("hidden");
		document.querySelectorAll(".stripe-button").forEach((e) => e.disabled = true);
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
				document.querySelectorAll(".stripe-button").forEach((e) => e.disabled = true);
			}
		} else {
			var text = await result.text();
			stripButtonPermanentDisable = true;
			document.querySelectorAll(".stripe-button").forEach((e) => e.disabled = true);
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

	var showError = function (errorMsgText) {
		loading(false);
		var errorMsg = document.querySelector("#error-message");
		errorMsg.textContent = errorMsgText;
		setTimeout(function () {
			errorMsg.textContent = "";
		}, 7000);
	};
	var loading = function (isLoading) {
		if (isLoading) {
			// Disable the button and show a spinner
			document.querySelectorAll(".stripe-button").forEach((e) => e.disabled = true);
			document.querySelector("#spinner").classList.remove("hidden");
			document.querySelector("#payment-button-text").classList.add("hidden");
		} else {
			document.querySelectorAll(".stripe-button").forEach((e) => e.disabled = false);
			document.querySelector("#spinner").classList.add("hidden");
			document.querySelector("#payment-button-text").classList.remove("hidden");
		}
	};
	var intent;
	var payment_result;
	var elements;
	var response;

	async function createPaymentIntent(addons) {
		const response = await fetch("<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase.createPaymentIntent') ?>", {
			method: "POST",
			headers: {
				"Content-Type": "application/json"
			},
			body: JSON.stringify({
				ticketId: "<?php echo $ticketId ?>",
				addons: addons,
				estimatedPrice: $totalPrice
			})
		});
		return response;
	}

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
			processOrder("<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase.addTicketToDb') ?>",
				"<?php echo JRoute::_('index.php?option=com_swa&view=membertickets') ?>",
				response.data.intentId);
		}

	});

	// END PAYMENT UTILS //

	//move the user to step 2 in the multistep form. We will make the intent then allow them to continue
	confirm_order.addEventListener("click", async function (event) {
		event.preventDefault();

		document.getElementById("loader").classList.remove("hidden");

		const stepNumber = parseInt(confirm_order.getAttribute("step_number"));
		navigateToFormStep(stepNumber);

		var addons = $generateAddonsArray();
		intent = await createPaymentIntent(addons);
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

				//create intent and mount
				document.getElementById("loader").classList.add("hidden");
				navigateToFormStep(stepNumber + 1);
			} else {
				showError(response.message);
				console.error(response.message);
			}
		} else {
			var text = await intent.text();
			Joomla.renderMessages({
				"error": [text]
			});
		}
	});

	edit_order.addEventListener("click", function (event) {
		event.preventDefault();
		const stepNumber = parseInt(edit_order.getAttribute("step_number"));
		navigateToFormStep(stepNumber);
	});


</script>
