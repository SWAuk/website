<?php

class RaceTypesTest extends SwaTestCase {

	public function testAddMultipleTypes() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminRaceTypes();

		$types = array(
			'Beginner',
			'Intermediate',
			'Wave',
		);

		foreach( $types as $type ) {
			$this->addAdminRaceType( $type );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=racetypes' );
		$this->clickAndWait("link=ID"); // Order by ID so we know the order!
		foreach( $types as $key => $type ) {
			$this->assertElementPresent( 'link=' . $type );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'racetypeList.' . $tableRow . '.1', $type );
		}

		foreach( $types as $type ) {
			$this->open( '/j/administrator/index.php?option=com_swa&view=racetypes' );
			$this->click( '//td/a[contains(text(),\'' . $type . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_name', $type );
		}

	}

}
