<?php

class SeasonsTest extends SwaTestCase {

	public function testAddMultipleSeasons() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->clearAdminSeasons();

		$seasons = array( 2015, 2016, 2017 );

		foreach( $seasons as $season ) {
			$this->addAdminSeason( $season );
		}

		$this->open( '/j/administrator/index.php?option=com_swa&view=seasons' );
		$this->clickAndWait("link=ID"); // Order by ID so we know the order!
		foreach( $seasons as $key => $season ) {
			$this->assertElementPresent( 'link=' . $season );
			$tableRow = strval( $key + 1 );
			$this->assertTable( 'seasonList.' . $tableRow . '.1', $season );
		}

		foreach( $seasons as $season ) {
			$this->open( '/j/administrator/index.php?option=com_swa&view=seasons' );
			$this->click( '//td/a[contains(text(),\'' . $season . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_year', $season );
		}

	}

}
