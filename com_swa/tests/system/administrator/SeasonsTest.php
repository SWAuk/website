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
		foreach( $seasons as $season ) {
			$this->assertElementPresent( 'link=' . $season );
			//TODO check the rest of the list table is correct
		}

		foreach( $seasons as $season ) {
			$this->open( '/j/administrator/index.php?option=com_swa&view=seasons' );
			$this->click( '//td/a[contains(text(),\'' . $season . '\')]/../preceding-sibling::td/input[@name=\'cid[]\']' );
			$this->clickAndWait( 'css=#toolbar-edit > button.btn.btn-small' );
			$this->assertValue( 'id=jform_year', $season );
		}

	}

}
