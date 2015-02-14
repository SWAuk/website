<?php


class UniversityMembersTest extends SwaTestCase {

	public function testAddMultipleQualifications() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminUniversityMembers();

		//Create joomla users
		$timestring = strval( time() );
		$users = array(
			'TestUser-' . $timestring . '-0',
			'TestUser-' . $timestring . '-1',
			'TestUser-' . $timestring . '-2',
		);
		foreach( $users as $username ) {
			$this->createAdminJoomlaUser( $username , 'somePass' );
		}

		//Add some universities
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uni1', 'http://foo.com' );
		$this->addAdminUniversity( 'uni2', 'http://foo.com' );

		//Create some members
		$this->clearAdminMembers();
		$this->addAdminMember(
			$users[0], false, 'Male', '1993-02-25', 'uni1', false, 'course',
			2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
		);
		$this->addAdminMember(
			$users[1], false, 'Male', '1993-02-25', 'uni1', false, 'course',
			2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
		);
		$this->addAdminMember(
			$users[2], false, 'Male', '1993-02-25', 'uni2', false, 'course',
			2016, 'Race', 'Intermediate', 'L', 'nm', '11', 'No thanks', false
		);

		$universityMembers = array(
			array( $users[0], 'uni1', false ),
			array( $users[1], 'uni1', true ),
			array( $users[2], 'uni2', false ),
		);

		foreach( $universityMembers as $data ) {
			list( $user, $uni, $graduated ) = $data;
			$this->addAdminUniversityMember( $user, $uni, $graduated );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=universitymembers' );
		foreach( $universityMembers as $key => $data ) {
			list( $user, $uni, $graduated ) = $data;
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'universitymemberList.' . $tableRow . '.2', $uni );
			$this->assertTable( 'universitymemberList.' . $tableRow . '.3', $user );
			if( $graduated ) {
				$this->assertTable( 'universitymemberList.' . $tableRow . '.4', '1' );
			} else {
				$this->assertTable( 'universitymemberList.' . $tableRow . '.4', '0' );
			}
		}

		foreach( $universityMembers as $key => $data ) {
			list( $user, $uni, $graduated ) = $data;
			$this->open( '/j/administrator/index.php?option=com_swa&view=universitymembers' );
			$this->click( 'id=cb' . $key );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_member_id', $user );
			$this->assertSelectedLabel( 'id=jform_university_id', $uni );
			if( $graduated ) {
				$this->assertValue( 'id=jform_graduated', 'on' );
			} else {
				$this->assertValue( 'id=jform_graduated', 'off' );
			}
		}

	}

} 