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
		}

	}

}
