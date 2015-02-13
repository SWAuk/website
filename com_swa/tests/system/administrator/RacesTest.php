<?php


class RacesTest extends SwaTestCase {

	public function testAddMultipleRaces() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminRaces();

		// Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uniA', 'http://foo.com' );

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		$this->clearAdminRaceTypes();
		$this->addAdminRaceType( 'type1' );
		$this->addAdminRaceType( 'type2' );
		$this->addAdminRaceType( 'type3' );


		$races = array(
			array( 'event1', 'type1' ),
			array( 'event1', 'type2' ),
			array( 'event2', 'type1' ),
			array( 'event2', 'type2' ),
			array( 'event2', 'type3' ),
		);

		foreach( $races as $race ) {
			list( $event, $type ) = $race;
			$this->addAdminRace( $event, $type );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=races' );

		foreach( $races as $key => $race ) {
			list( $event, $type ) = $race;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'raceList.' . $tableRow . '.1', $event );
			$this->assertTable( 'raceList.' . $tableRow . '.2', $type );
		}

		foreach( $races as $key => $race ) {
			list( $event, $type ) = $race;
			$this->open( '/j/administrator/index.php?option=com_swa&view=races' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertSelectedLabel( 'id=jform_race_type_id', $type );
		}

	}

} 