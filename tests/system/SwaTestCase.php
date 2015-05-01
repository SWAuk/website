<?php

class SwaTestCase extends SeleniumJoomlaTestCase {

	public function addAdminSeason( $season ) {
		echo "Adding season '$season'\n";
		$this->open( 'administrator/index.php?option=com_swa&view=seasons' );
		$this->clickAndWait( '//button[@onclick="Joomla.submitbutton(\'season.add\')"]' );
		$this->type( 'id=jform_year', $season );
		$this->clickAndWait( 'css=#toolbar-save > button.btn.btn-small' );
	}

	public function clearAdminSeasons() {
		$this->clearAdminList( 'seasons' );
	}

	public function addAdminUniversity( $name, $url ) {
		echo "Adding university '$name'\n";
		$this->open("administrator/index.php?option=com_swa&view=universities");
		$this->clickAndWait("//button[@onclick=\"Joomla.submitbutton('university.add')\"]");
		$this->type("id=jform_name", $name);
		$this->type("id=jform_url", $url);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminUniversities() {
		$this->clearAdminList( 'universities' );
	}

	public function addAdminCompetitionType( $name ){
		echo "Adding competition type '$name'\n";
		$this->open("administrator/index.php?option=com_swa&view=competitiontypes");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'competitiontype.add\')"]');
		$this->type("id=jform_name", $name);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminCompetitionTypes() {
		$this->clearAdminList( 'competitiontypes' );
	}

	public function addAdminMember(
		$username, $paid, $sex, $dob, $tel, $uni, $course, $graduation,
		$discipline, $level, $shirt, $econtact, $enum, $swahelp
	) {
		echo "Adding member '$username'\n";
		$this->open("administrator/index.php?option=com_swa&view=members");
		$this->clickAndWait("//button[@onclick=\"Joomla.submitbutton('member.add')\"]");
		$this->select( 'id=jform_user_id', $username );
		if( $paid ) {
			$this->click("id=jform_paid");
		}
		$this->select( 'id=jform_sex', $sex );
		$this->type("id=jform_dob", $dob);
		$this->type("id=jform_tel", $tel);
		$this->select( 'id=jform_university_id', $uni );
		$this->type("id=jform_course", $course);
		$this->type("id=jform_graduation", $graduation);
		$this->select( 'id=jform_discipline', $discipline );
		$this->select( 'id=jform_level', $level );
		$this->select( 'id=jform_shirt', $shirt );
		$this->type("id=jform_econtact", $econtact);
		$this->type("id=jform_enumber", $enum);
		$this->select( 'id=jform_swahelp', $swahelp );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");

	}

	public function clearAdminMembers() {
		$this->clearAdminList( 'members' );
	}

	public function addAdminEvent( $name, $season, $capacity, $open, $close, $date ) {
		echo "Adding event '$name'\n";
		$this->open("administrator/index.php?option=com_swa&view=events");
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
		$this->open("administrator/index.php?option=com_swa&view=eventhosts");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'eventhost.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->select( 'id=jform_university_id', $uni );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminEventHosts() {
		$this->clearAdminList( 'eventhosts' );
	}

	public function addAdminQualification( $user, $type, $expiry ) {
		echo "Adding qualification for '$user'\n";
		$this->open("administrator/index.php?option=com_swa&view=qualifications");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'qualification.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->select( 'id=jform_type', $type );
		$this->type( 'id=jform_expiry_date', $expiry );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminQualifications() {
		$this->clearAdminList( 'qualifications' );
	}

	public function addAdminUniversityMember( $user, $university, $committee, $graduated ) {
		echo "Adding university member for '$user'\n";
		$this->open("administrator/index.php?option=com_swa&view=universitymembers");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'universitymember.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->select( 'id=jform_university_id', $university );
		$this->select( 'id=jform_committee', $committee );
		if( $graduated ) {
			$this->click("id=jform_graduated");
		}
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminUniversityMembers() {
		$this->clearAdminList( 'universitymembers' );
	}

	public function addAdminDamage( $event, $university, $date, $cost ) {
		echo "Adding damage for '$university'\n";
		$this->open("administrator/index.php?option=com_swa&view=damages");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'damage.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->select( 'id=jform_university_id', $university );
		$this->type( 'id=jform_date', $date );
		$this->type( 'id=jform_cost', $cost );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminDamages() {
		$this->clearAdminList( 'damages' );
	}

	public function addAdminDeposit( $university, $date, $amount ) {
		echo "Adding deposit for '$university'\n";
		$this->open("administrator/index.php?option=com_swa&view=deposits");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'deposit.add\')"]');
		$this->select( 'id=jform_university_id', $university );
		$this->type( 'id=jform_date', $date );
		$this->type( 'id=jform_amount', $amount );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminDeposits() {
		$this->clearAdminList( 'deposits' );
	}

	public function addAdminEventRegistration( $event, $user, $expires ){
		echo "Adding event registration for '$event' and '$user'\n";
		$this->open("administrator/index.php?option=com_swa&view=eventregistrations");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'eventregistration.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->select( 'id=jform_member_id', $user );
		$this->type( 'id=jform_expires', $expires );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminEventRegistrations() {
		$this->clearAdminList( 'eventregistrations' );
	}

	public function addAdminEventTicket( $event, $name, $quantity, $price, $nSWA, $nXSWA, $nHost, $nInst ) {
		echo "Adding event ticket for '$event' named '$name'\n";
		$this->open("administrator/index.php?option=com_swa&view=eventtickets");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'eventticket.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->type( 'id=jform_name', $name );
		$this->type( 'id=jform_quantity', $quantity );
		$this->type( 'id=jform_price', $price );
		if( $nSWA ) {
			$this->click("id=jform_need_swa");
		}
		if( $nXSWA ) {
			$this->click("id=jform_need_xswa");
		}
		if( $nHost ) {
			$this->click("id=jform_need_host");
		}
		if( $nInst ) {
			$this->click("id=jform_need_qualification");
		}
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminEventTickets() {
		$this->clearAdminList( 'eventtickets' );
	}

	public function addAdminGrant(
		$event, $applyDate, $amount, $fundUse, $inst, $sortcode, $acNum, $acName,
		$financeDate, $financeId, $authDate, $authId, $payDate, $payId
	) {
		echo "Adding grant for '$event'\n";
		$this->open("administrator/index.php?option=com_swa&view=grants");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'grant.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->type( 'id=jform_application_date', $applyDate );
		$this->type( 'id=jform_amount', $amount );
		$this->type( 'id=jform_fund_use', $fundUse );
		$this->type( 'id=jform_instructions', $inst );
		$this->type( 'id=jform_ac_sortcode', $sortcode );
		$this->type( 'id=jform_ac_number', $acNum );
		$this->type( 'id=jform_ac_name', $acName );
		$this->type( 'id=jform_finances_date', $financeDate );
		$this->type( 'id=jform_finances_id', $financeId );
		$this->type( 'id=jform_auth_date', $authDate );
		$this->type( 'id=jform_auth_id', $authId );
		$this->type( 'id=jform_payment_date', $payDate );
		$this->type( 'id=jform_payment_id', $payId );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminGrants() {
		$this->clearAdminList( 'grants' );
	}

	public function addAdminIndividualResult( $user, $competition, $result ) {
		echo "Adding individual result for '$user'\n";
		$this->open("administrator/index.php?option=com_swa&view=individualresults");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'individualresult.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->select( 'id=jform_competition_id', $competition );
		$this->type( 'id=jform_result', $result );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminIndividualResults() {
		$this->clearAdminList( 'individualresults' );
	}

	public function addAdminTeamResult( $competition, $uni, $teamNumber, $result ) {
		echo "Adding team result for '$uni' team '$teamNumber'\n";
		$this->open("administrator/index.php?option=com_swa&view=teamresults");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'teamresult.add\')"]');
		$this->select( 'id=jform_competition_id', $competition );
		$this->select( 'id=jform_university_id', $uni );
		$this->type( 'id=jform_team_number', $teamNumber );
		$this->type( 'id=jform_result', $result );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminTeamResults() {
		$this->clearAdminList( 'teamresults' );
	}

	public function addAdminCompetition( $event, $competitionType ) {
		echo "Adding competition for '$event' named '$competitionType'\n";
		$this->open("administrator/index.php?option=com_swa&view=competitions");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'competition.add\')"]');
		$this->select( 'id=jform_event_id', $event );
		$this->select( 'id=jform_competition_type_id', $competitionType );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminCompetitions() {
		$this->clearAdminList( 'competitions' );
	}

	public function addAdminTicket( $user, $eventTicket ) {
		echo "Adding ticket for '$user' named '$eventTicket'\n";
		$this->open("administrator/index.php?option=com_swa&view=tickets");
		$this->clickAndWait('//button[@onclick="Joomla.submitbutton(\'ticket.add\')"]');
		$this->select( 'id=jform_member_id', $user );
		$this->select( 'id=jform_event_ticket_id', $eventTicket );
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearAdminTickets() {
		$this->clearAdminList( 'tickets' );
	}

	public function createAdminJoomlaUser( $username, $password ) {
		echo "Creating Joomla user '$username'\n";
		$this->open("administrator/index.php?option=com_swa&view=members");
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
		$this->open( 'administrator/index.php?option=com_swa&view=' . $viewName );
		// Only bother clearing if there is at least 1 item...
		if( $this->isElementPresent( 'id=cb0' ) ) {
			$this->click( 'name=checkall-toggle' );
			$this->clickAndWait( 'css=#toolbar-delete > button.btn.btn-small' );
		}
	}

}
