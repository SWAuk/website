<?php

/**
 * This test exists to ensure that joomla looks like it is correctly working...
 */
class AdminLoginTest extends SeleniumJoomlaTestCase {

	public function testLogInLogOut() {
		$this->setUp();
		$this->gotoAdmin();
		$this->doAdminLogin();
		$this->doAdminLogout();
	}

}
