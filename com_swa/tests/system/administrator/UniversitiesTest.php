<?php

class UniversitiesTest extends SwaTestCase {

	public function testAddMultipleUniversities() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminUniversities();

		$unis = array(
			array( 'Bristol University', 'https://www.ubu.org.uk/activities/societies/7666/' ),
			array( 'Exeter University', 'http://sport.exeter.ac.uk/studentsport/au/listofclubs/windriders/' ),
			array( 'University of the West of England', 'https://uwesu.org/sport/windsurfandkite/' ),
		);

		foreach( $unis as $uni ) {
			list( $name, $url ) = $uni;
			$this->addAdminUniversity( $name, $url );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=universities' );
		foreach( $unis as $key => $uni ) {
			list( $name, $url ) = $uni;
			$this->assertElementPresent( 'link=' . $name );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'universityList.' . $tableRow . '.1', $name );
			$this->assertTable( 'universityList.' . $tableRow . '.2', $url );
		}

		foreach( $unis as $uni ) {
			list( $name, $url ) = $uni;
			$this->open( '/j/administrator/index.php?option=com_swa&view=universities' );
			$this->click( '//td/a[contains(text(),\'' . $name . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_name', $name );
			$this->assertValue( 'id=jform_url', $url );
		}

	}

}
