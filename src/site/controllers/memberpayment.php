<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerMemberPayment extends SwaController {

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
		if ( !empty( $missingKeys ) ) {
			JLog::add(
				'MemberPayment callback called with missing $data items: ' .
				implode( ',', $missingKeys ),
				JLog::ERROR,
				'com_swa.payment_callback'
			);
			die( 'Posted data is missing stuff!' );
		}

		// Extra specific validation
		if ( intval( $data['amount'] ) != 5 ) {
			JLog::add(
				'MemberPayment callback called with wrong membership amount: ' . $data['amount'],
				JLog::ERROR,
				'com_swa.payment_callback'
			);
			die( 'Membership amount was wrong' );
		}
		if ( substr( $data['order_id'], 0, 13 ) != 'j3membership:' ) {
			JLog::add(
				'MemberPayment callback called with bad looking order_id: ' . $data['order_id'],
				JLog::ERROR,
				'com_swa.payment_callback'
			);
			die ( 'Order id looks wrong' );
		}

		// Post back to nochex
		$response = $this->http_post( "www.nochex.com", 80, "/nochex.dll/apc/apc", $data );
		// stores the response from the Nochex server
		$debug = "IP -> " . $_SERVER['REMOTE_ADDR'] . "\r\n\r\nPOST DATA:\r\n";
		foreach ( $data as $Index => $Value ) {
			$debug .= "$Index -> $Value\r\n";
		}
		$debug .= "\r\nRESPONSE:\r\n$response";

		// Check the result from nochex
		if ( !strstr(
			$response,
			"AUTHORISED"
		)
		) {  // searches response to see if AUTHORISED is present if it isn’t a failure message is displayed
			//NOTE: NOT AUTHORISED
			JLog::add(
				'MemberPayment callback called and nochex did not authorise: ' . $debug,
				JLog::INFO,
				'com_swa.payment_callback'
			);
		} else {
			//NOTE: AUTHORISED
			// Update the membership status for the member!
			$memberId = str_replace( 'j3membership:', '', $data['order_id'] );
			$db = JFactory::getDbo();
			$query = $db->getQuery( true );
			$query->update( $db->quoteName( '#__swa_membership' ) )
				->set(
					array(
						$db->quoteName( 'paid' ) . ' = 1',
					)
				)
				->where(
					array(
						$db->quoteName( 'id' ) . ' = ' . $db->quote( $memberId ),
						$db->quoteName( 'paid' ) . ' = 0',
					)
				);
			$db->setQuery( $query );
			$result = $db->execute();

			if ( $result === false ) {
				JLog::add(
					'MemberPayment callback called and authed but failed to update db. order_id: ' .
					$data['order_id'],
					JLog::ERROR,
					'com_swa.payment_callback'
				);
				die( 'Failed to update member in db' );
			} else {
				JLog::add(
					'Member ' . $memberId . ' bought membership',
					JLog::INFO,
					'com_swa.audit_frontend'
				);
			}
		}
	}

	private function http_post( $server, $port, $url, $vars ) {
		// get urlencoded vesion of $vars array
		$urlencoded = "";
		foreach ( $vars as $Index => $Value ) // loop round variables and encode them to be used in query
		{
			$urlencoded .= urlencode( $Index ) . "=" . urlencode( $Value ) . "&";
		}
		$urlencoded =
			substr(
				$urlencoded,
				0,
				-1
			);   // returns portion of string, everything but last character

		$headers = "POST $url HTTP/1.0\r\n"  // headers to be sent to the server
			. "Content-Type: application/x-www-form-urlencoded\r\n"
			. "Content-Length: " . strlen( $urlencoded ) . "\r\n\r\n";  // length of the string

		$fp = fsockopen( $server, $port, $errno, $errstr, 10 );  // returns file pointer
		if ( !$fp ) {
			return "ERROR: fsockopen failed.\r\nError no: $errno - $errstr";
		}  // if cannot open socket then display error message

		fputs( $fp, $headers );  //writes to file pointer
		fputs( $fp, $urlencoded );

		$ret = "";
		while ( !feof( $fp ) ) {
			$ret .= fgets( $fp, 1024 );
		} // while it’s not the end of the file it will loop
		fclose( $fp );  // closes the connection
		return $ret; // array
	}

}