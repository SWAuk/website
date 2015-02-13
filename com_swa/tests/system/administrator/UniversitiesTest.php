<?php

class UniversitiesTest extends SwaAdminTestCase {

	public function testAddMultipleSeasons() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearUniversities();

		$unis = array(
			array( 'Bristol University', 'https://www.ubu.org.uk/activities/societies/7666/' ),
			array( 'University of the West of England', 'https://uwesu.org/sport/windsurfandkite/' ),
			array( 'Exeter University', 'http://sport.exeter.ac.uk/studentsport/au/listofclubs/windriders/' ),
		);

		foreach( $unis as $uni ) {
			list( $name, $url ) = $uni;
			$this->addUniversity( $name, $url );
		}
		$this->open( '/j/administrator/index.php?option=com_swa&view=universities' );
		foreach( $unis as $uni ) {
			list( $name, $url ) = $uni;
			$this->assertElementPresent( 'link=' . $name );
		}

	}

} 