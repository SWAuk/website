<?php

defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/assets/stripe-config.php';

// load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );

$app = JFactory::getApplication();
$jinput =$app->input;
$option = $jinput->get('option');
$ticket_id = $app->getUserState("$option.ticket_id");
$ticket = null;

foreach ($this->items as $item) {
    if ($item->id == $ticket_id) {
        $ticket = $item;
        break;
    }
}

if ($ticket === null) {
    echo "<p><b>There has been an error retrieving the selected ticket. If this problem continues contact us at webmaster@swa.co.uk</b></p>";
    die;
}

?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
    jQuery(document).ready(function() {
        $tshirt_size = jQuery('#tshirt_size');
        // only disable the stripe button if the user has to select a t-shirt size
        if ( $tshirt_size.length ) {
            $stripeBtn = jQuery('.stripe-button-el');
            $stripeBtn.prop('disabled', true);

            // enable/disable button when the t-shirt size is changed
            $tshirt_size.change(function (event) {
                if (jQuery(this).val() == "NULL") {
                    $stripeBtn.prop('disabled', true);
                } else {
                    $stripeBtn.prop('disabled', false);
                }
            });
        }
    });
</script>

<h1>Order Summary</h1>


<form action="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase'); ?>" method="POST" >
    <input type="hidden" name="option" value="com_swa" />
    <input type="hidden" name="task" value="ticketpurchase.submit" />
    <input type="hidden" name="return" value="index.php?option=com_swa&view=membertickets" />
    <input type="hidden" name="ticketId" value="<?php echo $ticket->id ?>" />

    <table class="table">
        <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>1</td>
            <td>
                <div><?php echo $ticket->event_name . ' - ' .  $ticket->ticket_name ?></div>
                <?php if (!empty($ticket->details->tshirt_included)): ?>
                    <div style="font-size: 10pt; margin-left: 20px;">
                        T-Shirt Size:
                        <select id="tshirt_size" name="tshirt_size">
                            <option value="NULL">-- SELECT --</option>
                            <option value="Female XS">Female XS</option>
                            <option value="Female S">Female S</option>
                            <option value="Female M">Female M</option>
                            <option value="Female L">Female L</option>
                            <option value="Female XL">Female XL</option>
                            <option value="Male XS">Male XS</option>
                            <option value="Male S">Male S</option>
                            <option value="Male M">Male M</option>
                            <option value="Male L">Male L</option>
                            <option value="Male XL">Male XL</option>
                        </select>
                    </div>
                <?php endif ?>
            </td>
            <td><?php echo '£' . $ticket->price ?></td>
        </tr>
    </table>

    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $stripe['publishable_key']; ?>"
        data-amount="<?php echo $ticket->price * 100 ?>"
        data-currency="GBP"
        data-label="Pay now!"
        data-name="SWA"
        data-description="<?php echo $ticket->event_name . ' - ' . $ticket->ticket_name; ?>"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-zip-code="true"
        data-email="<?php echo $this->user->email ?>"
        data-allow-remember-me="false">
    </script>
</form>