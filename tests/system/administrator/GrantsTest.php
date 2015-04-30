<?php


class GrantsTest extends SwaTestCase {

	public function testAddMultipleGrants() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminGrants();

		// Add a season
		$this->clearAdminSeasons();
		$this->addAdminSeason( 2015 );

		// Add events
		$this->clearAdminEvents();
		$this->addAdminEvent( 'event1', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event2', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );
		$this->addAdminEvent( 'event3', 2015, 100, '2015-01-01', '2015-01-10', '2015-01-15' );

		$grants = array(
			array( 'event1', '2015-02-25', 500, 'text', 'blah', '77-88-99', 12345678, 'name', '2015-03-03', 123, '2015-04-04', 456, '2015-05-05', 789 ),
			array( 'event2', '2014-02-25', 1, 'text', 'LA LA LA LA LA LA LA', '77-88-99', 12345678, 'name', '2014-03-03', 1, '2014-04-04', 2, '2014-05-05', 3 ),
			array( 'event3', '2014-02-25', 100, 'Longer use..', '', '11-11-11', 99999999, 'ac name', '2014-03-03', 123, '2014-04-04', 456, '2014-05-05', 789 ),
		);

		foreach( $grants as $grant ) {
			list( $event, $apDate, $amount, $use, $inst, $sort, $acc, $name, $fDate, $fId, $aDate, $aId, $pDate, $pId ) = $grant;
			$this->addAdminGrant( $event, $apDate, $amount, $use, $inst, $sort, $acc, $name, $fDate, $fId, $aDate, $aId, $pDate, $pId );
		}

		$this->open( 'administrator/index.php?option=com_swa&view=grants' );
		foreach( $grants as $key => $grant ) {
			list( $event, $apDate, $amount, $use, $inst, $sort, $acc, $name, $fDate, $fId, $aDate, $aId, $pDate, $pId ) = $grant;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'grantList.' . $tableRow . '.1', $event );
			$this->assertTable( 'grantList.' . $tableRow . '.2', $apDate );
			$this->assertTable( 'grantList.' . $tableRow . '.3', $amount );
			$this->assertTable( 'grantList.' . $tableRow . '.4', $fDate );
			$this->assertTable( 'grantList.' . $tableRow . '.5', $aDate );
			$this->assertTable( 'grantList.' . $tableRow . '.6', $pDate );
		}

		foreach( $grants as $key => $grant ) {
			list( $event, $apDate, $amount, $use, $inst, $sort, $acc, $name, $fDate, $fId, $aDate, $aId, $pDate, $pId ) = $grant;
			$this->open( 'administrator/index.php?option=com_swa&view=grants' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_event_id', $event );
			$this->assertValue( 'id=jform_application_date', $apDate );
			$this->assertValue( 'id=jform_amount', $amount );
			$this->assertValue( 'id=jform_fund_use', $use );
			$this->assertValue( 'id=jform_instructions', $inst );
			$this->assertValue( 'id=jform_ac_sortcode', $sort );
			$this->assertValue( 'id=jform_ac_number', $acc );
			$this->assertValue( 'id=jform_ac_name', $name );
			$this->assertValue( 'id=jform_finances_date', $fDate );
			$this->assertValue( 'id=jform_finances_id', $fId );
			$this->assertValue( 'id=jform_auth_date', $aDate );
			$this->assertValue( 'id=jform_auth_id', $aId );
			$this->assertValue( 'id=jform_payment_date', $pDate );
			$this->assertValue( 'id=jform_payment_id', $pId );
		}
	}

} 