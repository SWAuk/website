<?php

class ComponentMenuAdminTest extends SwaAdminTestCase {

	public function testMenuItemsGoToCorrectPages() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();

		$pages = array(
			// array( Link, Expected Title )
			array( 'SWA', 'SWA home' ),
			array( 'Members', 'Members' ),
			array( 'University Members', 'University Members' ),
			array( 'Instructors', 'Instructors' ),
			array( 'Events', 'Events' ),
			array( 'Event Hosts', 'Event hosts' ),
			array( 'Event Registrations', 'Event Registrations' ),
			array( 'Event Tickets', 'Event tickets' ),
			array( 'Tickets', 'Tickets' ),
			array( 'Deposits', 'Deposits' ),
			array( 'Damages', 'Damages' ),
			array( 'Grants', 'Grants' ),
			array( 'Universities', 'Universities' ),
			array( 'Seasons', 'Seasons' ),
			array( 'Races', 'Races' ),
			array( 'Race Types', 'Race types' ),
			array( 'Team Results', 'Team results' ),
			array( 'Individual Results', 'Individual results' ),
		);

		$this->open("/j/administrator/index.php?option=com_swa");
		foreach( $pages as $data ) {
			list( $linkName, $expectedTitle ) = $data;
			$this->click( "link=Components" );
			$this->click( "link=" . $linkName );
			$this->waitForPageToLoad( "30000" );
			$this->assertEquals( $expectedTitle , $this->getText( "css=h1.page-title" ) );
		}

	}

} 