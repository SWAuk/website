<?php


class TeamResultsTest extends SwaTestCase {

	public function testAddMultipleTeamResults() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminTeamResults();

		//Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uni1', 'http://foo.com' );
		$this->addAdminUniversity( 'uni2', 'http://foo.com' );

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		// Add race types
		$this->clearAdminRaceTypes();
		$this->addAdminRaceType( 'type1' );
		$this->addAdminRaceType( 'type2' );

		// Add Races
		$this->clearAdminRaces();
		$this->addAdminRace( 'event1', 'type1' );
		$this->addAdminRace( 'event1', 'type2' );
		$this->addAdminRace( 'event2', 'type1' );
		$this->addAdminRace( 'event2', 'type2' );

		$teamResults = array(
			array( 'uni1', 1, 'event1', 'type1', 12 ),
			array( 'uni1', 2, 'event1', 'type2', 11 ),
			array( 'uni1', 3, 'event1', 'type2', 10 ),
			array( 'uni2', 1, 'event2', 'type2', 29 ),
			array( 'uni2', 2, 'event1', 'type1', 18 ),
			array( 'uni2', 2, 'event2', 'type1', 27 ),
		);

		foreach( $teamResults as $resultData ) {
			list( $uni, $team, $event, $raceType, $result ) = $resultData;
			$this->addAdminTeamResult( $event . ' - ' . $raceType, $uni, $team, $result );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=teamresults' );
		foreach( $teamResults as $key => $resultData ) {
			list( $uni, $team, $event, $raceType, $result ) = $resultData;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'teamresultList.' . $tableRow . '.1', $uni );
			$this->assertTable( 'teamresultList.' . $tableRow . '.2', $team );
			$this->assertTable( 'teamresultList.' . $tableRow . '.3', $event );
			$this->assertTable( 'teamresultList.' . $tableRow . '.4', $raceType );
			$this->assertTable( 'teamresultList.' . $tableRow . '.5', $result );
		}

		foreach( $teamResults as $key => $resultData ) {
			list( $uni, $team, $event, $raceType, $result ) = $resultData;
			$this->open( '/j/administrator/index.php?option=com_swa&view=teamresults' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_race_id', $event . ' - ' . $raceType );
			$this->assertSelectedLabel( 'id=jform_university_id', $uni );
			$this->assertValue( 'id=jform_team_number', $team );
			$this->assertValue( 'id=jform_result', $result );
		}
	}

} 