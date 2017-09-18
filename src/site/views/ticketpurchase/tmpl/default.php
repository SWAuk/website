<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );

require_once JPATH_COMPONENT . '/assets/stripe-config.php';

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$doc = JFactory::getDocument();
$doc->addScript( JUri::base() . '/components/com_swa/assets/js/form.js' );
?>

	<!--</style>-->
	<script type="text/javascript">
		getScript( '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
			jQuery( document ).ready( function () {
				jQuery( '#form-member' ).submit( function ( event ) {
				} );
			} );
		} );
	</script>

	<h1>Ticket Purchasing</h1>

<?php
if ( empty( $this->items ) ) {
	echo "<p><b>There are currently no tickets that you can buy!</b></p>";
} else {
	?>
	<p>Tickets are sometimes released in batches, if one is marked as 'SOLD OUT' check back soon!</p>
	<p>If you can not see any tickets here then maybe there are no events? Make sure you president has registered you for the event! If you want an instructor ticket make sure you have submitted your qualifications.</p>
	<p>Keep an eye on social media as we will post about all ticket releases there!</p>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Event</th>
			<th>Event Date</th>
			<th>Ticket Deadline</th>
			<th>Ticket</th>
			<th>Price</th>
			<th>Notes</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $this->items as $item ) {
			echo "<tr>\n";
			echo "<td>" . $item->event_name . "</td>\n";
			echo "<td>" . $item->event_date . "</td>\n";
			echo "<td>" . $item->ticket_close . "</td>\n";
			echo "<td>" . $item->ticket_name . "</td>\n";
			echo "<td>" . $item->price . "</td>\n";
			echo "<td>" . $item->notes . "</td>\n";
			echo "<td>";

			if( $item->reason ) {
				echo $item->reason;
			} else {

				?>
				<form action="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase') ?>" method="POST" >
					<input type="hidden" name="option" value="com_swa" />
					<input type="hidden" name="task" value="ticketpurchase.select" />
					<input type="hidden" name="ticketId" value="<?php echo $item->id ?>" />
					<button class="btn favth-btn-small" type="submit" >Select</button>
				</form>
			<?php
			}

			echo "</td>\n";
			echo "</tr>\n";
		}
		?>
		</tbody>
	</table>
<?php
}
