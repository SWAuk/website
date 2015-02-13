<?php

class SwaTestCase extends SeleniumJoomlaTestCase {

	public function addAdminSeason( $season ) {
		echo "Adding season '$season'\n";
		$this->open( '/j/administrator/index.php?option=com_swa&view=seasons' );
		$this->clickAndWait( '//button[@onclick="Joomla.submitbutton(\'season.add\')"]' );
		$this->type( 'id=jform_year', $season );
		$this->clickAndWait( 'css=#toolbar-save > button.btn.btn-small' );
	}

	public function clearAdminSeasons() {
		$this->clearAdminList( 'seasons' );
	}

	public function addAdminUniversity( $name, $url ) {
		echo "Adding university '$name'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=universities");
		$this->clickAndWait("//button[@onclick=\"Joomla.submitbutton('university.add')\"]");
		$this->type("id=jform_name", $name);
		$this->type("id=jform_url", $url);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminUniversities() {
		$this->clearAdminList( 'universities' );
	}

	public function addAdminRaceType( $name ){
		echo "Adding race type '$name'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=racetypes");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'racetype.add\')"]');
		$this->type("id=jform_name", $name);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminRaceTypes() {
		$this->clearAdminList( 'racetypes' );
	}

	public function addAdminMember(
		$username, $paid, $sex, $dob, $uni, $isClubComm, $course, $graduation,
		$discipline, $level, $shirt, $econtact, $enum, $swahelp, $isSwaComm
	) {
		echo "Adding member '$username'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=members");
		$this->clickAndWait("//button[@onclick=\"Joomla.submitbutton('member.add')\"]");
		$this->select( 'id=jform_user_id', $username );
		if( $paid ) {
			$this->click("id=jform_paid");
		}
		$this->select( 'id=jform_sex', $sex );
		$this->type("id=jform_dob", $dob);
		$this->select( 'id=jform_university_id', $uni );
		if( $isClubComm ){
			$this->click("id=jform_club_committee");
		}
		$this->type("id=jform_course", $course);
		$this->type("id=jform_graduation", $graduation);
		$this->select( 'id=jform_discipline', $discipline );
		$this->select( 'id=jform_level', $level );
		$this->select( 'id=jform_shirt', $shirt );
		$this->type("id=jform_econtact", $econtact);
		$this->type("id=jform_enumber", $enum);
		$this->select( 'id=jform_swahelp', $swahelp );
		if( $isSwaComm ){
			$this->click("id=jform_swa_committee");
		}
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");

	}

	public function clearAdminMembers() {
		$this->clearAdminList( 'members' );
	}

	public function addAdminEvent( $name, $season, $capacity, $open, $close, $date ) {
		echo "Adding event '$name'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=events");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'event.add\')"]');
		$this->type("id=jform_name", $name);
		$this->select( 'id=jform_season_id', $season );
		$this->type("id=jform_capacity", $capacity);
		$this->type("id=jform_date_open", $open);
		$this->type("id=jform_date_close", $close);
		$this->type("id=jform_date", $date);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminEvents() {
		$this->clearAdminList( 'events' );
	}

	public function addAdminEventHost( $event, $uni ) {
		echo "Adding event host '$event' and '$uni'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=eventhosts");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'eventhost.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->select( 'id=jform_university_id', $uni );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminEventHosts() {
		$this->clearAdminList( 'eventhosts' );
	}

	public function addAdminInstructor( $user, $level, $expiry ) {
		echo "Adding instructor for '$user'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=instructors");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'instructor.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->type( 'id=jform_level', $level );
		$this->type( 'id=jform_expiry_date', $expiry );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminInstructors() {
		$this->clearAdminList( 'instructors' );
	}

	public function addAdminUniversityMember( $user, $university, $graduated ) {
		echo "Adding university member for '$user'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=universitymembers");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'universitymember.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->select( 'id=jform_university_id', $university );
		if( $graduated ) {
			$this->click("id=jform_graduated");
		}
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminUniversityMembers() {
		$this->clearAdminList( 'universitymembers' );
	}

	public function createAdminJoomlaUser( $username, $password ) {
		echo "Creating Joomla user '$username'\n";
		$this->open("/j/administrator/index.php?option=com_swa&view=members");
		$this->click("link=Users");
		$this->clickAndWait("link=Add New User");
		$this->type("id=jform_name", $username);
		$this->type("id=jform_username", $username);
		$this->type("id=jform_password", $password);
		$this->type("id=jform_password2", $password);
		$this->type("id=jform_email", $username . "@test.swa.co.uk");
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	private function clearAdminList( $viewName ) {
		echo "Clearing $viewName List\n";
		$this->open( '/j/administrator/index.php?option=com_swa&view=' . $viewName );
		// Only bother clearing if there is at least 1 item...
		if( $this->isElementPresent( 'id=cb0' ) ) {
			$this->click( 'name=checkall-toggle' );
			$this->clickAndWait( 'css=#toolbar-delete > button.btn.btn-small' );
		}
	}

}
