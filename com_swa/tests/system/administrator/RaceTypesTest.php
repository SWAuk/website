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
		foreach( $types as $type ) {
			$this->assertElementPresent( 'link=' . $type );
			//TODO check the rest of the list table is correct
		}

		foreach( $types as $type ) {
			$this->open( '/j/administrator/index.php?option=com_swa&view=racetypes' );
			$this->click( '//td/a[contains(text(),\'' . $type . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_name', $type );
		}

	}

}
