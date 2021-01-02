<?php

namespace SWA\Test\Browser;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

/**
 * Test for login with the provided test users.
 * Ensures that:
 *  - Login and Logout menu items appear at the correct time.
 *  - The view access plugin displays the club and org menus at the correct time.
 */
final class LoginAndMenuTest extends SWABrowserTestCase
{

	private function elementExists( string $cssSelector ) : bool
	{
		try{
			$this->webDriver->findElement(WebDriverBy::cssSelector($cssSelector));
			return true;
		}
		catch ( NoSuchElementException $e)
		{
			return false;
		}
	}

	private function assertLoggedIn()
	{
		$this->assertTrue($this->elementExists('a[href="/index.php/logout"]'));
	}

	private function assertLoggedOut()
	{
		$this->assertTrue($this->elementExists('a[href="/index.php/login"]'));
	}

	public function provideTestUserDetails()
	{
		yield [ 'admin', 'password', [] ];
		yield [ 'johnsmith', 'password', [] ];
		yield [ 'janesmith', 'password', [] ];
		yield [ 'mthomp', 'password', [] ];
		yield [ 'bendover', 'password', [] ];
		yield [ 'swacom', 'password', [ 'org' ] ];
		yield [ 'unicom', 'password', [ 'club' ] ];
	}

	/**
	 * @dataProvider provideTestUserDetails
	 */
	public function testUserLoginAndExpectedMenus( string $username, string $password, array $expectedMenus = [] )
	{
		$this->webDriver->get($this->baseUrl . '/index.php/login');

		// Make sure we start logged out
		$this->assertLoggedOut();

		$loginButton = $this->webDriver->findElement(WebDriverBy::cssSelector('div.login > form button'));
		$usernameField = $this->webDriver->findElement(WebDriverBy::cssSelector('#username'));
		$passwordField = $this->webDriver->findElement(WebDriverBy::cssSelector('#password'));

		$usernameField->sendKeys($username);
		$passwordField->sendKeys($password);
		$loginButton->click();

		// We should no be logged in
		$this->assertLoggedIn();

		// Check that the plugin shows us the correct menu items
		$this->assertEquals(
			in_array('org', $expectedMenus),
			$this->elementExists('#fav-nav > .favnav .nav a[href="/index.php/organisation/my-details"]'),
			"Failed to assert 'org' menu was in the correct state."
		);
		$this->assertEquals(
			in_array('club', $expectedMenus),
			$this->elementExists('#fav-nav > .favnav .nav a[href="/index.php/club/members"]'),
			"Failed to assert 'club' menu was in the correct state."
		);
	}
}
