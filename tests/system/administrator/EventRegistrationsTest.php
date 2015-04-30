<?php


class EventRegistrationsTest extends SwaTestCase {

	public function testAddMultipleEventRegistrations() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminEventRegistrations();

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 400, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		//Create joomla users
		$timestring = strval( time() );
		$users = array(
			'TestUser-' . $timestring . '-0',
			'TestUser-' . $timestring . '-1',
		);
		foreach( $users as $username ) {
			$this->createAdminJoomlaUser( $username , 'somePass' );
		}

		//Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uni1', 'http://foo.com' );

		//Create some members
		$this->clearAdminMembers();
		$this->addAdminMember(
			$users[0], false, 'Male', '1993-02-25', 'uni1', false, 'course',
			2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
		);
		$this->addAdminMember(
			$users[1], false, 'Male', '1993-02-25', 'uni1', false, 'course',
			2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
		);

		$eventRegistrations = array(
			array( 'event1', $users[0], '2016-03-22' ),
			array( 'event2', $users[0], '2015-02-01' ),
			array( 'event1', $users[1], '2014-10-01' ),
			array( 'event2', $users[1], '2014-09-01' ),
		);

		foreach( $eventRegistrations as $eventRegistration ) {
			list( $event, $member, $expires ) = $eventRegistration;
			$this->addAdminEventRegistration( $event, $member, $expires );
		}

		$this->open( 'administrator/index.php?option=com_swa&view=eventregistrations' );
		foreach( $eventRegistrations as $key => $eventRegistration ) {
			list( $event, $member, $expires ) = $eventRegistration;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'eventregistrationList.' . $tableRow . '.1', $event );
			$this->assertTable( 'eventregistrationList.' . $tableRow . '.2', $member );
			$this->assertTable( 'eventregistrationList.' . $tableRow . '.3', $expires );
		}

		foreach( $eventRegistrations as $key => $eventRegistration ) {
			list( $event, $member, $expires ) = $eventRegistration;
			$this->open( 'administrator/index.php?option=com_swa&view=eventregistrations' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertSelectedLabel( 'id=jform_member_id', $member );
			$this->assertValue( 'id=jform_expires', $expires );
		}

	}

} 