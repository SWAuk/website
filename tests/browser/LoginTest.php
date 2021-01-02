<?php

namespace SWA\Test\Browser;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

/**
 * Test for login with the provided test users.
 * Also make sure that the login and logout buttons do the correct thing.
 */
final class LoginTest extends SWABrowserTestCase
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
		yield [ 'admin', 'password' ];
		yield [ 'johnsmith', 'password' ];
		yield [ 'janesmith', 'password' ];
		yield [ 'mthomp', 'password' ];
		yield [ 'bendover', 'password' ];
		yield [ 'swacom', 'password' ];
		yield [ 'unicom', 'password' ];
	}

	/**
	 * @dataProvider provideTestUserDetails
	 */
	public function testUserLogin( string $username, string $password )
	{
		$this->webDriver->get($this->baseUrl . '/index.php/login');

		$this->assertLoggedOut();

		$loginButton = $this->webDriver->findElement(WebDriverBy::cssSelector('div.login > form button'));
		$usernameField = $this->webDriver->findElement(WebDriverBy::cssSelector('#username'));
		$passwordField = $this->webDriver->findElement(WebDriverBy::cssSelector('#password'));

		$usernameField->sendKeys($username);
		$passwordField->sendKeys($password);
		$loginButton->click();

		$this->assertLoggedIn();
	}
}
