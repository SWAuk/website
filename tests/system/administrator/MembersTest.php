<?php

class MembersTest extends SwaTestCase {

	public function testAddMultipleMembers() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminMembers();

		//Create joomla users
		$timestring = strval( time() );
		$users = array(
			'TestUser-' . $timestring . '-0',
			'TestUser-' . $timestring . '-1',
		);
		$this->createAdminJoomlaUser( $users[0] , 'somePass' );
		$this->createAdminJoomlaUser( $users[1] , 'somePass' );

		//Add some universities
		$unis = array( 'uni1', 'uni2' );
		$this->clearAdminUniversities();
		$this->addAdminUniversity( $unis[0], 'http://foo.com' );
		$this->addAdminUniversity( $unis[1], 'http://foo.com' );

		$members = array(
			// username, paid, sex, dob, uni, course, grad, discipline, level, shirt, ename, enum, swahelp
			array( $users[0], false, 'Male', '1990-01-24', '+441803155555', $unis[0], 'c1', 2017, 'Race', 'Intermediate', 'L', 'ename', '123', 'No thanks' ),
			array( $users[1], true, 'Female', '1989-06-10', '+441803111111', $unis[1], 'c2', 2016, 'Freestyle', 'Advanced', '12', 'aname', '999', 'Website' ),
		);

		foreach( $members as $d ) {
			$this->addAdminMember($d[0], $d[1], $d[2], $d[3], $d[4], $d[5], $d[6], $d[7], $d[8], $d[9], $d[10], $d[11], $d[12], $d[13]);
		}

		//Make sure the users appear in the list!
		$this->open( 'administrator/index.php?option=com_swa&view=members' );
		foreach( $members as $key => $d ) {
			$this->assertTextPresent( $d[0] );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'memberList.' . $tableRow . '.1', $d[0] );
			$this->assertTable( 'memberList.' . $tableRow . '.2', preg_quote( $d[4] ) );
			if( $d[1] ) {
				$this->assertTable( 'memberList.' . $tableRow . '.3', '1' );
			} else {
				$this->assertTable( 'memberList.' . $tableRow . '.3', '0' );
			}

		}

		//Make sure each user actually has the correct data
		foreach( $members as $d ) {
			$this->open( 'administrator/index.php?option=com_swa&view=members' );
			$this->click( '//td[contains(text(),\'' . $d[0] . '\')]/preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertSelectedLabel( 'id=jform_user_id', preg_quote( $d[0] . ' (Already Member)' ) );
			if( $d[1] ) {
				$this->assertValue( 'id=jform_paid', 'on' );
			} else {
				$this->assertValue( 'id=jform_paid', 'off' );
			}
			$this->assertSelectedLabel( 'id=jform_sex', $d[2] );
			$this->assertValue( 'id=jform_dob', $d[3] );
			$this->assertValue( 'id=jform_tel', preg_quote( $d[4] ) );
			$this->assertSelectedLabel( 'id=jform_university_id', $d[5] );
			$this->assertValue( 'id=jform_course', $d[6] );
			$this->assertValue( 'id=jform_graduation', $d[7] );
			$this->assertSelectedLabel( 'id=jform_discipline', $d[8] );
			$this->assertSelectedLabel( 'id=jform_level', $d[9] );
			$this->assertSelectedLabel( 'id=jform_shirt', $d[10] );
			$this->assertValue( 'id=jform_econtact', $d[11] );
			$this->assertValue( 'id=jform_enumber', $d[12] );
			$this->assertSelectedLabel( 'id=jform_swahelp', $d[13] );
		}

	}

}
