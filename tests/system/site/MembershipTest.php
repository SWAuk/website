<?php

class MembershipTest extends SwaTestCase {

	public function testMemberRegistrationSequence() {
		$this->setUp();

		//Setup required stuff in admin section
		$this->gotoAdmin();
		$this->doAdminLogin();
		$username = 'TestUser-' . strval( time() ) . '-0';
		$password = 'pass123';
		$this->createAdminJoomlaUser( $username, $password );
		$this->clearAdminMembers();
		$this->clearAdminUniversities();
		$this->addAdminUniversity( 'uni1', 'http://foo.com' );
		$this->doAdminLogout();

		// Do first stage registration
		$this->doLogin( $username, $password );
		$this->open( 'index.php?option=com_swa&view=memberregistration' );
		$this->select( 'id=jform_sex', 'Male' );
		$this->type("id=jform_dob", '1990-02-02');
		$this->type("id=jform_tel", '+4401112223334');
		$this->select( 'id=jform_university_id', 'uni1' );
		$this->type("id=jform_course", "Computing");
		$this->type("id=jform_graduation", "2017");
		$this->select( 'id=jform_discipline', 'Race' );
		$this->select( 'id=jform_level', 'Advanced' );
		$this->select( 'id=jform_shirt', 'L' );
		$this->type("id=jform_econtact", "some person");
		$this->type("id=jform_enumber", "123456789");
		$this->select( 'id=jform_dietary', 'Vegan' );
		$this->select( 'id=jform_swahelp', 'Events' );
		$this->clickAndWait("//button[@type='submit']");
		// Make sure we are redirect to the right place
		$this->assertEquals("Membership Payment", $this->getText("css=h1"));
		$this->assertTextPresent( 'Item saved successfully' );
		$this->doLogout();

		// Check the details have been saved correctly
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->open("administrator/index.php?option=com_swa&view=members");
		$this->click( 'id=cb0' );
		$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
		$this->assertSelectedLabel( 'id=jform_user_id', $username . ' \(Already Member\)' );
		$this->assertValue( 'id=jform_paid', 'off' );
		$this->assertSelectedLabel( 'id=jform_sex', 'Male' );
		$this->assertValue( 'id=jform_dob', '1990-02-02' );
		$this->assertValue( 'id=jform_tel', '\+4401112223334' );
		$this->assertSelectedLabel( 'id=jform_university_id', 'uni1' );
		$this->assertValue( 'id=jform_course', 'Computing' );
		$this->assertValue( 'id=jform_graduation', '2017' );
		$this->assertSelectedLabel( 'id=jform_discipline', 'Race' );
		$this->assertSelectedLabel( 'id=jform_level', 'Advanced' );
		$this->assertSelectedLabel( 'id=jform_shirt', 'L' );
		$this->assertValue( 'id=jform_econtact', 'some person' );
		$this->assertValue( 'id=jform_enumber', '123456789' );
		$this->assertSelectedLabel( 'id=jform_dietary', 'Vegan' );
		$this->assertSelectedLabel( 'id=jform_swahelp', 'Events' );
		// Now mark as paid!
		$this->click("id=jform_paid");
		$this->clickAndWait( '//button[@onclick="Joomla.submitbutton(\'member.apply\')"]' );
		$this->assertValue( 'id=jform_paid', 'on' );
		$this->open("administrator/index.php?option=com_swa&view=members");
		$this->doAdminLogout();

		//Check everything after payment
		$this->doLogin( $username, $password );
		//Each one of these locations should redirect to the memberdetails view
		$viewRedirectChain = array(
			'index.php?option=com_swa&view=memberregistration',
			'index.php?option=com_swa&view=memberpayment',
			'index.php?option=com_swa&view=memberdetails',
		);
		foreach( $viewRedirectChain as $viewLocation ) {
			$this->open( $viewLocation );
			$this->assertEquals("Membership Details", $this->getText("css=h1"));
			$expectedRows = array(
				'Yes',
				'Male',
				'1990-02-02',
				'\+4401112223334',
				'uni1',
				'Computing',
				'2017',
				'Race',
				'Advanced',
				'L',
				'some person',
				'123456789',
				'Vegan',
				'Events',
			);
			foreach( $expectedRows as $key => $rowValue ) {
				$this->assertTable( 'css=table.' . ($key + 1) . '.1', $rowValue );
			}
		}

	}

} 