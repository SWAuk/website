<?php

class SwaAdminTestCase extends SeleniumJoomlaTestCase {

	public function addSeason( $season ) {
		$this->open( '/j/administrator/index.php?option=com_swa&view=seasons' );
		$this->clickAndWait( '//button[@onclick="Joomla.submitbutton(\'season.add\')"]' );
		$this->type( 'id=jform_year', $season );
		$this->clickAndWait( 'css=#toolbar-save > button.btn.btn-small' );
	}

	public function clearSeasons() {
		$this->clearList( 'seasons' );
	}

	public function addUniversity( $name, $url ) {
		$this->open("/j/administrator/index.php?option=com_swa&view=universities");
		$this->clickAndWait("//button[@onclick=\"Joomla.submitbutton('university.add')\"]");
		$this->type("id=jform_name", $name);
		$this->type("id=jform_url", $url);
		$this->clickAndWait("css=#toolbar-save > button.btn.btn-small");
	}

	public function clearUniversities() {
		$this->clearList( 'universities' );
	}

	private function clearList( $viewName ) {
		$this->open( '/j/administrator/index.php?option=com_swa&view=' . $viewName );
		// Only bother clearing if there is at least 1 item...
		if( $this->isElementPresent( 'id=cb0' ) ) {
			$this->click( 'name=checkall-toggle' );
			$this->clickAndWait( 'css=#toolbar-delete > button.btn.btn-small' );
		}
	}

}
