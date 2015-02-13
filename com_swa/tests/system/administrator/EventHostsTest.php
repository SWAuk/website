<?php

class EventHostsTest extends SwaTestCase {

	public function testAddMultipleEventHosts() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminEventHosts();

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
		$this->addAdminEvent( 'event2', 2015, 50, '2015-02-01', '2015-02-10', '2015-02-15' );


		$eventHosts = array(
			// name, season, capacity, open, close, date
			array( 'event1', 'uniA' ),
			array( 'event1', 'uniB' ),
			array( 'event2', 'uniA' ),
		);

		foreach( $eventHosts as $host ) {
			list( $event, $uni ) = $host;
			$this->addAdminEventHost( $event, $uni );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=eventhosts' );
		$this->clickAndWait("link=ID"); // Order by ID so we know the order!

		foreach( $eventHosts as $key => $host ) {
			list( $event, $uni ) = $host;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'evenhostList.' . $tableRow . '.1', $event );
			$this->assertTable( 'evenhostList.' . $tableRow . '.2', $uni );
		}

		foreach( $eventHosts as $key => $host ) {
			list( $event, $uni ) = $host;
			$this->open( '/j/administrator/index.php?option=com_swa&view=eventhosts' );
			$this->clickAndWait( "link=ID" ); // Order by ID so we know the order!
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertSelectedLabel( 'id=jform_university_id', $uni );
		}

	}

} 