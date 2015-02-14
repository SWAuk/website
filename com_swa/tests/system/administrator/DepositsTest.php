<?php


class DepositsTest extends SwaTestCase {

	public function testAddMultipleDeposits() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminDeposits();

		// Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uniA', 'http://foo.com' );
		$this->addAdminUniversity( 'uniB', 'http://foo.com' );

		$deposits = array(
			array( 'uniA', '2014-12-01', 50 ),
			array( 'uniB', '2014-05-05', 25 ),
			array( 'uniA', '2015-02-19', 50 ),
			array( 'uniB', '2014-07-01', 33 ),
		);

		foreach( $deposits as $deposit ) {
			list( $university, $date, $amount ) = $deposit;
			$this->addAdminDeposit( $university, $date, $amount );
		}

		//Make sure the list appears correct
		$this->open( '/j/administrator/index.php?option=com_swa&view=deposits' );
		foreach( $deposits as $key => $deposit ) {
			list( $university, $date, $amount ) = $deposit;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'depositList.' . $tableRow . '.1', $university );
			$this->assertTable( 'depositList.' . $tableRow . '.2', $date );
			$this->assertTable( 'depositList.' . $tableRow . '.3', $amount );
		}

		//Make sure each item is actually correct
		foreach( $deposits as $key => $deposit ) {
			list( $university, $date, $amount ) = $deposit;
			$this->open( '/j/administrator/index.php?option=com_swa&view=deposits' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_university_id', $university );
			$this->assertValue( 'id=jform_date', $date );
			$this->assertValue( 'id=jform_amount', $amount );
		}
	}

} 