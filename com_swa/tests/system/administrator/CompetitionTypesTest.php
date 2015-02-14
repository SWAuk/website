<?php

class CompetitionTypesTest extends SwaTestCase {

	public function testAddMultipleTypes() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminCompetitionTypes();

		$types = array(
			'Beginner',
			'Intermediate',
			'Wave',
		);

		foreach( $types as $type ) {
			$this->addAdminCompetitionType( $type );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=competitiontypes' );
		foreach( $types as $key => $type ) {
			$this->assertElementPresent( 'link=' . $type );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'competitiontypeList.' . $tableRow . '.1', $type );
		}

		foreach( $types as $type ) {
			$this->open( '/j/administrator/index.php?option=com_swa&view=competitiontypes' );
			$this->click( '//td/a[contains(text(),\'' . $type . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_name', $type );
		}

	}

}
