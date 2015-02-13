<?php


class DamagesTest extends SwaTestCase {

	public function testAddMultipleDamages() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminDamages();

		// Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uniA', 'http://foo.com' );
		$this->addAdminUniversity( 'uniB', 'http://foo.com' );

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		$damages = array(
			array( 'event1', 'uniA', '2014-12-01', '50' ),
			array( 'event1', 'uniB', '2014-09-20', '40' ),
			array( 'event2', 'uniA', '2014-11-01' , '25' ),
		);

		foreach( $damages as $damage ) {
			list( $event, $university, $date, $cost ) = $damage;
			$this->addAdminDamage( $event, $university, $date, $cost );
		}

		//Make sure the list appears correct
		$this->open( '/j/administrator/index.php?option=com_swa&view=damages' );
		foreach( $damages as $key => $damage ) {
			list( $event, $university, $date, $cost ) = $damage;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'damageList.' . $tableRow . '.1', $university );
			$this->assertTable( 'damageList.' . $tableRow . '.2', $event );
			$this->assertTable( 'damageList.' . $tableRow . '.3', $date );
			$this->assertTable( 'damageList.' . $tableRow . '.4', $cost );
		}

		//Make sure each item is actually correct
		foreach( $damages as $key => $damage ) {
			list( $event, $university, $date, $cost ) = $damage;
			$this->open( '/j/administrator/index.php?option=com_swa&view=damages' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertSelectedLabel( 'id=jform_university_id', $university );
			$this->assertValue( 'id=jform_date', $date );
			$this->assertValue( 'id=jform_cost', $cost );
		}
	}

} 