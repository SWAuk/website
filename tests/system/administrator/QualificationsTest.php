<?php

class QualificationsTest extends SwaTestCase {

	public function testAddMultipleQualifications() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminQualifications();

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
				$user, false, 'Male', '1993-02-25', '+441803111111', 'uni1', 'course', 2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks'
			);
		}

		$qualifications = array(
			array( $users[0], 'Powerboat Level 2', '2016-02-11' ),
			array( $users[1], 'Powerboat Level 2', '2016-02-11' ),
			array( $users[1], 'Start Windsurfing Instructor', '2017-01-11' ),
			array( $users[1], 'Intermediate Windsurfing Instructor', '2017-01-11' ),
		);

		foreach( $qualifications as $data ) {
			list( $user, $type, $expiry ) = $data;
			$this->addAdminQualification( $user, $type, $expiry );
		}

		$this->open( 'administrator/index.php?option=com_swa&view=qualifications' );
		foreach( $qualifications as $key => $data ) {
			list( $user, $type, $expiry ) = $data;
			$this->assertElementPresent( 'link=' . $user );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'qualificationslist.' . $tableRow . '.1', $user );
			$this->assertTable( 'qualificationslist.' . $tableRow . '.2', $type );
			$this->assertTable( 'qualificationslist.' . $tableRow . '.3', $expiry );
		}

		foreach( $qualifications as $key => $data ) {
			list( $user, $type, $expiry ) = $data;
			$this->open( 'administrator/index.php?option=com_swa&view=qualifications' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_member_id', $user );
			$this->assertSelectedLabel( 'id=jform_type', $type );
			$this->assertValue( 'id=jform_expiry_date', $expiry );
		}

	}

} 