<?php


class CompetitionsTest extends SwaTestCase {

	public function testAddMultipleCompetitions() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminCompetitions();

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

		$this->clearAdminCompetitionTypes();
		$this->addAdminCompetitionType( 'type1' );
		$this->addAdminCompetitionType( 'type2' );
		$this->addAdminCompetitionType( 'type3' );


		$competitions = array(
			array( 'event1', 'type1' ),
			array( 'event1', 'type2' ),
			array( 'event2', 'type1' ),
			array( 'event2', 'type2' ),
			array( 'event2', 'type3' ),
		);

		foreach( $competitions as $competition ) {
			list( $event, $type ) = $competition;
			$this->addAdminCompetition( $event, $type );
		}

		$this->open( 'administrator/index.php?option=com_swa&view=competitions' );

		foreach( $competitions as $key => $competition ) {
			list( $event, $type ) = $competition;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'competitionList.' . $tableRow . '.1', $event );
			$this->assertTable( 'competitionList.' . $tableRow . '.2', $type );
		}

		foreach( $competitions as $key => $competition ) {
			list( $event, $type ) = $competition;
			$this->open( 'administrator/index.php?option=com_swa&view=competitions' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertSelectedLabel( 'id=jform_competition_type_id', $type );
		}

	}

} 