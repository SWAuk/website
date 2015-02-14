<?php

class InstructorsTest extends SwaTestCase {

	public function testAddMultipleInstructors() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminInstructors();

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
				$user, false, 'Male', '1993-02-25', 'uni1', false, 'course',
				2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
			);
		}

		$instructors = array(
			array( $users[0], 'PB2', '2016-02-11' ),
			array( $users[1], 'PB2', '2016-02-11' ),
			array( $users[1], 'Start Windsurf', '2017-01-11' ),
			array( $users[1], 'Intermediate Windsurf', '2017-01-11' ),
		);

		foreach( $instructors as $data ) {
			list( $user, $level, $expiry ) = $data;
			$this->addAdminInstructor( $user, $level, $expiry );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=instructors' );
		foreach( $instructors as $key => $data ) {
			list( $user, $level, $expiry ) = $data;
			$this->assertElementPresent( 'link=' . $user );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'instructorslist.' . $tableRow . '.1', $user );
			$this->assertTable( 'instructorslist.' . $tableRow . '.2', $level );
			$this->assertTable( 'instructorslist.' . $tableRow . '.3', $expiry );
		}

		foreach( $instructors as $key => $data ) {
			list( $user, $level, $expiry ) = $data;
			$this->open( '/j/administrator/index.php?option=com_swa&view=instructors' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_member_id', $user );
			$this->assertValue( 'id=jform_level', $level );
			$this->assertValue( 'id=jform_expiry_date', $expiry );
		}

	}

} 