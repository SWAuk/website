<?php

namespace SWA\Test\Browser;

use Facebook\WebDriver\WebDriverBy;

/**
 * Trait for Joomla User interactions
 */
trait UserTrait
{
	protected static $PASSWORD = 'password';

	protected static $USER_ADMIN = 'admin';

	protected static $USER_COMMITTIE_SWA = 'swacom';

	protected static $USER_UNIVERSITY_SWA = 'unicom';

	protected static $USER_JOHNSMITH = 'johnsmith';

	protected static $USER_JANESMITH = 'johnsmith';

	protected static $USER_MTHOMP = 'mthomp';

	protected static $USER_BENDOVER = 'bendover';

	/**
	 * Must already be navigated to a page that displays the main nav menu
	 */
	protected function assertLoggedIn()
	{
		$this->assertTrue(
			$this->elementExists('a[href="/index.php/logout"]'),
			"Failed to find logout button (but we should be logged in)"
		);
	}

	/**
	 * Must already be navigated to a page that displays the main nav menu
	 */
	protected function assertLoggedOut()
	{
		$this->assertTrue(
			$this->elementExists('a[href="/index.php/login"]'),
			"Failed to find login button (but we should be logged out)"
		);
	}

	/**
	 * Login to the user with assertions
	 */
	protected function login( string $username, string $password ) : void
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

	/**
	 * Login to the user with assertions
	 */
	protected function userRegister(
		string $name,
		string $username,
		string $password,
		string $email
	) : void
	{
		$this->webDriver->get($this->baseUrl . '/index.php/login?view=registration');

		$this->assertLoggedOut();

		$button = $this->webDriver->findElement(WebDriverBy::cssSelector('#member-registration button'));
		$nameField = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_name'));
		$usernameField = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_username'));
		$password1Field = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_password1'));
		$password2Field = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_password2'));
		$email1Field = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_email1'));
		$email2Field = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_email2'));

		$nameField->sendKeys($name);
		$usernameField->sendKeys($username);
		$password1Field->sendKeys($password);
		$password2Field->sendKeys($password);
		$email1Field->sendKeys($email);
		$email2Field->sendKeys($email);

		$button->click();

		// TODO assert page redirect maybe?
	}

}
