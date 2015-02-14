<?php


class EventTicketsTest extends SwaTestCase {

	public function testAddMultipleEventTickets() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminEventTickets();

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'e1', 2015, 400, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'e2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		$eventTickets = array(
			array( 'e1', 'Party', 200, 10, false, false, false, false ),
			array( 'e1', 'Windsurf', 80, 17, false, false, false, false ),
			array( 'e1', 'XSWA', 100, 20, false, false, true, false ),
			array( 'e1', 'Qualification', 20, 12, false, false, false, true ),
			array( 'e1', 'SWA', 20, 12, true, false, false, false ),
			array( 'e2', 'host', 30, 0, false, false, true, false ),
			array( 'e2', 'other', 30, 10, false, false, false, false ),
		);

		foreach( $eventTickets as $eventTicket ) {
			list( $event, $name, $quantity, $price, $nSWA, $nXSWA, $nHost, $nInst ) = $eventTicket;
			$this->addAdminEventTicket( $event, $name, $quantity, $price, $nSWA, $nXSWA, $nHost, $nInst );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=eventtickets' );
		foreach( $eventTickets as $key => $eventTicket ) {
			list( $event, $name, $quantity, $price, $nSWA, $nXSWA, $nHost, $nInst ) = $eventTicket;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'eventticketList.' . $tableRow . '.1', $event );
			$this->assertTable( 'eventticketList.' . $tableRow . '.2', $name );
			$this->assertTable( 'eventticketList.' . $tableRow . '.3', $quantity );
			$this->assertTable( 'eventticketList.' . $tableRow . '.4', $price );
			if( $nSWA ) {
				$this->assertTable( 'eventticketList.' . $tableRow . '.5', '1' );
			} else {
				$this->assertTable( 'eventticketList.' . $tableRow . '.5', '0' );
			}
			if( $nXSWA ) {
				$this->assertTable( 'eventticketList.' . $tableRow . '.6', '1' );
			} else {
				$this->assertTable( 'eventticketList.' . $tableRow . '.6', '0' );
			}
			if( $nHost ) {
				$this->assertTable( 'eventticketList.' . $tableRow . '.7', '1' );
			} else {
				$this->assertTable( 'eventticketList.' . $tableRow . '.7', '0' );
			}
			if( $nInst ) {
				$this->assertTable( 'eventticketList.' . $tableRow . '.8', '1' );
			} else {
				$this->assertTable( 'eventticketList.' . $tableRow . '.8', '0' );
			}
		}

		foreach( $eventTickets as $key => $eventTicket ) {
			list( $event, $name, $quantity, $price, $nSWA, $nXSWA, $nHost, $nInst ) = $eventTicket;
			$this->open( '/j/administrator/index.php?option=com_swa&view=eventtickets' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertValue( 'id=jform_name', $name );
			$this->assertValue( 'id=jform_quantity', $quantity );
			$this->assertValue( 'id=jform_price', $price );
			if( $nSWA ) {
				$this->assertValue( 'id=jform_need_swa', 'on' );
			} else {
				$this->assertValue( 'id=jform_need_swa', 'off' );
			}
			if( $nXSWA ) {
				$this->assertValue( 'id=jform_need_xswa', 'on' );
			} else {
				$this->assertValue( 'id=jform_need_xswa', 'off' );
			}
			if( $nHost ) {
				$this->assertValue( 'id=jform_need_host', 'on' );
			} else {
				$this->assertValue( 'id=jform_need_host', 'off' );
			}
			if( $nInst ) {
				$this->assertValue( 'id=jform_need_qualification', 'on' );
			} else {
				$this->assertValue( 'id=jform_need_qualification', 'off' );
			}
		}
	}

} 