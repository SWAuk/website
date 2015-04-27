<?php


class TicketsTest extends SwaTestCase {

	public function testAddMultipleTickets() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminTickets();

		//Create joomla users
		$timestring = strval( time() );
		$users = array(
			'TestUser-' . $timestring . '-0',
			'TestUser-' . $timestring . '-1',
		);
		$this->createAdminJoomlaUser( $users[0] , 'somePass' );
		$this->createAdminJoomlaUser( $users[1] , 'somePass' );

		//Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uni1', 'http://foo.com' );

		//Create some members
		$this->clearAdminMembers();
		foreach( $users as $user ) {
			$this->addAdminMember(
				$user, false, 'Male', '1993-02-25', 'uni1', false, 'course',
				2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
			);
		}

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add event
		$this->clearAdminEvents();
		$this->addAdminEvent( 'e1', 2015, 400, '2015-01-01', '2015-01-10', '2015-01-15' );

		// Add event tickets
		$this->clearAdminEventTickets();
		$this->addAdminEventTicket( 'e1', 'ticket1', 10, 10, false, false, false, false );
		$this->addAdminEventTicket( 'e1', 'ticket2', 20, 20, false, false, false, false );
		$this->addAdminEventTicket( 'e1', 'ticket3', 30, 30, false, false, false, false );

		$tickets = array(
			array( $users[0], 'e1', 'ticket1' ),
			array( $users[0], 'e1', 'ticket2' ),
			array( $users[0], 'e1', 'ticket3' ),
			array( $users[1], 'e1', 'ticket2' ),
			array( $users[1], 'e1', 'ticket3' ),
		);

		foreach( $tickets as $ticket ) {
			list( $user, $event, $ticketName ) = $ticket;
			$this->addAdminTicket( $user, $event . ' - ' . $ticketName );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=tickets' );
		foreach( $tickets as $key => $ticket ) {
			list( $user, $event, $ticketName ) = $ticket;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'ticketList.' . $tableRow . '.1', $user );
			$this->assertTable( 'ticketList.' . $tableRow . '.2', $event );
			$this->assertTable( 'ticketList.' . $tableRow . '.3', $ticketName );
		}

		foreach( $tickets as $key => $ticket ) {
			list( $user, $event, $ticketName ) = $ticket;
			$this->open( '/j/administrator/index.php?option=com_swa&view=tickets' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_member_id', $user );
			$this->assertSelectedLabel( 'id=jform_event_ticket_id', $event . ' - ' . $ticketName );
		}

	}

} 