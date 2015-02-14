<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerTicketPurchase extends SwaController {

	public function callback() {
		// Get the data from the call
		$props = $this->getProperties();
		/** @var JInput $input */
		$input = $props['input'];
		$data = $input->getArray();

		// Die is some data is missing
		$missingKeys = array_diff_key(
			array(
				'to_email',
				'from_email',
				'transaction_id',
				'transaction_date',
				'order_id',
				'amount',
				'security_key',
				'status',
			),
			array_keys( $data )
		);
		if( !empty( $missingKeys ) ) {
			JLog::add( 'TicketPurchase callback called with missing $data items: ' . implode( ',', $missingKeys ), JLog::ERROR, 'com_swa' );
			die( 'Posted data is missing stuff!' );
		}

		// NOTE: ths receives ... 'j3ticket:' . $item->id . '-' . $this->member->id;
		if (substr( $data['order_id'] , 0, 9) != 'j3ticket:') {
			JLog::add( 'TicketPurchase callback called with bad looking order_id1: ' . $data['order_id'], JLog::ERROR, 'com_swa' );
			die ( 'Order id looks wrong, pt1' );
		}

		//Extract info from the order_id!
		$orderIdParts = explode( ':', $data['order_id'] );
		if( !strstr( '-', $orderIdParts[1] ) ) {
			JLog::add( 'TicketPurchase callback called with bad looking order_id2: ' . $data['order_id'], JLog::ERROR, 'com_swa' );
			die ( 'Order id looks wrong, pt2' );
		}
		$orderIdParts = explode( '-', $data['order_id'] );
		$eventTicketId = $orderIdParts[0];
		$memberId = $orderIdParts[1];

		// Make sure the eventTicket stuff is right
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'event_ticket.*' );
		$query->from( $db->quoteName('#__swa_event_ticket') . ' as event_ticket' );
		$query->where( 'event_ticket.id = ' . $eventTicketId );
		$db->setQuery( $query );
		if( !$db->execute() ) {
			JLog::add( 'TicketPurchase db check 1 failed', JLog::ERROR, 'com_swa' );
			die ( 'TicketPurchase db check 1 failed' );
		}
		$eventTicket = $db->loadObject();
		// Validate the price of event ticket
		if( intval( $data['amount'] ) != intval( $eventTicket->price ) ) {
			JLog::add( 'TicketPurchase callback called with wrong ticket amount: ' . $data['amount'] . ' expected:' . $eventTicket->price, JLog::ERROR, 'com_swa' );
			die( 'Ticket amount was wrong' );
		}

		// Post back to nochex
		$response = $this->http_post("www.nochex.com", 80, "/nochex.dll/apc/apc", $data);
		// stores the response from the Nochex server
		$debug = "IP -> " . $_SERVER['REMOTE_ADDR'] ."\r\n\r\nPOST DATA:\r\n";
		foreach($data as $Index => $Value)
			$debug .= "$Index -> $Value\r\n";
		$debug .= "\r\nRESPONSE:\r\n$response";

		// Check the result from nochex
		if (!strstr($response, "AUTHORISED")) {  // searches response to see if AUTHORISED is present if it isn’t a failure message is displayed
			//NOTE: NOT AUTHORISED
			JLog::add( 'TicketPurchase callback called and nochex did not authorise: ' . $debug, JLog::INFO, 'com_swa' );
		}
		else {
			//NOTE: AUTHORISED
			// Update / add the ticket to the db
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query
				->insert($db->quoteName('#__swa_ticket'))
				->columns($db->quoteName( array( 'member_id', 'event_ticket_id' ) ))
				->values(implode(',', array( $memberId, $eventTicketId )));
			$db->setQuery($query);
			$result = $db->execute();

			if( $result === false ) {
				JLog::add( 'TicketPurchase callback called and authed but failed to update db. order_id: ' . $data['order_id'] , JLog::ERROR, 'com_swa' );
				die( 'Failed to update db' );
			}
		}
	}

	private function http_post($server, $port, $url, $vars) {
		// get urlencoded vesion of $vars array
		$urlencoded = "";
		foreach ($vars as $Index => $Value) // loop round variables and encode them to be used in query
			$urlencoded .= urlencode($Index ) . "=" . urlencode($Value) . "&";
		$urlencoded = substr($urlencoded,0,-1);   // returns portion of string, everything but last character

		$headers = "POST $url HTTP/1.0\r\n"  // headers to be sent to the server
			. "Content-Type: application/x-www-form-urlencoded\r\n"
			. "Content-Length: ". strlen($urlencoded) . "\r\n\r\n";  // length of the string

		$fp = fsockopen($server, $port, $errno, $errstr, 10);  // returns file pointer
		if (!$fp) return "ERROR: fsockopen failed.\r\nError no: $errno - $errstr";  // if cannot open socket then display error message

		fputs($fp, $headers);  //writes to file pointer
		fputs($fp, $urlencoded);

		$ret = "";
		while (!feof($fp)) $ret .= fgets($fp, 1024); // while it’s not the end of the file it will loop
		fclose($fp);  // closes the connection
		return $ret; // array
	}

}