<?php

/**
 * Methods could be sourced from:
 * https://raw.githubusercontent.com/worldwideinterweb/joomla-cms/6eb659a0af1f1178f288a6e52e990e9fd62f3be1/tests/system/SeleniumJoomlaTestCase.php
 */
class SeleniumJoomlaTestCase extends PHPUnit_Extensions_SeleniumTestCase {

	/**
	 * @var SeleniumConfig
	 */
	protected $cfg;

	public function setUp() {
		$this->cfg = new SeleniumConfig();
		$this->setBrowser( "*chrome" );
		$this->setBrowserUrl( $this->cfg->path );
	}

	/**
	 * Wrapper around open to relate only to the site we are testing
	 *
	 * @param string $location
	 * @return void
	 */
	public function open( $location ) {
		parent::open( $this->cfg->path . $location );
	}

	function gotoAdmin() {
		echo "Browsing to back end.\n";
		$this->open("administrator");
		$this->waitForPageToLoad("30000");
	}

	function doAdminLogin($username = null,$password = null)
	{
		echo "Logging in to back end.\n";
		if(!isset($username))$username = $this->cfg->username;
		if(!isset($password))$password = $this->cfg->password;
		if (!$this->isElementPresent("mod-login-username"))
		{
			$this->gotoAdmin();
			$this->click( "link=Log out" );
			$this->waitForPageToLoad("30000");
		}
		$this->type("mod-login-username", $username);
		$this->type("mod-login-password", $password);
		if( $this->isElementPresent( 'link=Log in' ) ) {
			$this->click( "link=Log in" );
		} else {
			$this->click( "//form[@id='form-login']/fieldset/div[3]/div/div/button" );
		}
		$this->waitForPageToLoad("30000");
	}

	function doAdminLogout()
	{
		echo "Logging out of back end.\n";
		$this->click("link=Log out");
		$this->waitForPageToLoad("30000");
	}

	function doLogin( $username, $password ) {
		$this->open( "index.php/component/users" );
		$this->type("id=username", $username);
		$this->type("id=password", $password);
		$this->click("xpath=(//button[@type='submit'])[2]");
		$this->waitForPageToLoad("30000");
	}

	function doLogout() {
		$this->open( "index.php/component/users" );
		$this->click("//button[@type='submit']");
		$this->waitForPageToLoad("30000");
	}

}