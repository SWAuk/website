<?php


class IndividualResultsTest extends SwaTestCase {

	public function testAddMultipleIndividualResults() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminIndividualResults();

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
				$user, false, 'Male', '1993-02-25', '+441803111111', 'uni1', false, 'course', 2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
			);
		}

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		// Add competition types
		$this->clearAdminCompetitionTypes();
		$this->addAdminCompetitionType( 'type1' );
		$this->addAdminCompetitionType( 'type2' );

		// Add Competitions
		$this->clearAdminCompetitions();
		$this->addAdminCompetition( 'event1', 'type1' );
		$this->addAdminCompetition( 'event1', 'type2' );
		$this->addAdminCompetition( 'event2', 'type1' );
		$this->addAdminCompetition( 'event2', 'type2' );

		$individualResults = array(
			array( $users[0], 'event1', 'type1', 12 ),
			array( $users[0], 'event2', 'type1', 13 ),
			array( $users[1], 'event1', 'type2', 200 ),
			array( $users[1], 'event2', 'type2', 250 ),
		);

		foreach( $individualResults as $resultData ) {
			list( $user, $event, $competitionType, $result ) = $resultData;
			$this->addAdminIndividualResult( $user, $event . ' - ' . $competitionType, $result );
		}

		$this->open( 'administrator/index.php?option=com_swa&view=individualresults' );
		foreach( $individualResults as $key => $resultData ) {
			list( $user, $event, $competitionType, $result ) = $resultData;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'individualresultList.' . $tableRow . '.1', $user );
			$this->assertTable( 'individualresultList.' . $tableRow . '.2', $event );
			$this->assertTable( 'individualresultList.' . $tableRow . '.3', $competitionType );
			$this->assertTable( 'individualresultList.' . $tableRow . '.4', $result );
		}

		foreach( $individualResults as $key => $resultData ) {
			list( $user, $event, $competitionType, $result ) = $resultData;
			$this->open( 'administrator/index.php?option=com_swa&view=individualresults' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_competition_id', $event . ' - ' . $competitionType );
			$this->assertSelectedLabel( 'id=jform_member_id', $user );
			$this->assertValue( 'id=jform_result', $result );
		}
	}

} 