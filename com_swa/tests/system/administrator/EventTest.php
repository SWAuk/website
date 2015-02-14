<?php

class EventTest extends SwaTestCase {

	public function testAddMultipleEvents() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminEvents();

		//Add seasons to use
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2014 );
		$this->addAdminSeason( 2015 );

		$events = array(
			// name, season, capacity, open, close, date
			array( 'BrUWE', 2014, 100, '2014-07-10', '2014-07-20', '2014-07-22' ),
			array( 'Northern Monkey', 2015, 200, '2015-04-10', '2015-04-20', '2015-04-22' ),
		);

		foreach( $events as $event ) {
			list( $name, $season, $capacity, $open, $close, $date ) = $event;
			$this->addAdminEvent( $name, $season, $capacity, $open, $close, $date );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=events' );
		foreach( $events as $key => $event ) {
			list( $name, $season, $capacity, $open, $close, $date ) = $event;
			$tableRow = strval( $key + 1 );
			$this->assertElementPresent( 'link=' . $name );
			$this->assertTable( 'eventList.' . $tableRow . '.1', $name );
			$this->assertTable( 'eventList.' . $tableRow . '.2', $season );
			$this->assertTable( 'eventList.' . $tableRow . '.3', $capacity );
			$this->assertTable( 'eventList.' . $tableRow . '.4', $open );
			$this->assertTable( 'eventList.' . $tableRow . '.5', $close );
			$this->assertTable( 'eventList.' . $tableRow . '.6', $date );
		}

		foreach( $events as $event ) {
			list( $name, $season, $capacity, $open, $close, $date ) = $event;
			$this->open( '/j/administrator/index.php?option=com_swa&view=events' );
			$this->click( '//td/a[contains(text(),\'' . $name . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_name', $name );
			$this->assertSelectedLabel( 'id=jform_season_id', $season );
			$this->assertValue( 'id=jform_capacity', $capacity );
			$this->assertValue( 'id=jform_date_open', $open );
			$this->assertValue( 'id=jform_date_close', $close );
			$this->assertValue( 'id=jform_date', $date );
		}

	}

} 