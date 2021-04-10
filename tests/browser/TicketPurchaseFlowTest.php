<?php

namespace SWA\Test\Browser;

use Facebook\WebDriver\WebDriverBy;

final class TicketPurchaseFlowTest extends SWABrowserTestCase
{

	public function testFlow()
	{
		$username = 'TicketPurchaseFlowTestUser' . time();
		$name = $username;
		$password = 'password';
		$email = $username . '@test.swa.co.uk';

		/*
		Create an account and login
		Note: the register page shows errors, but the registration is a success
		*/

		$this->userRegister($name, $username, $password, $email);
		$this->login($username, $password);

		// Register a membership
		$this->registerMembership();

		/*
		Approve uni member, and register for event
		TODO logout of this user
		TODO log into unicom user
		TODO approve member to the club
		TODO register member for event
		TODO log out
		TODO log back into normal user
		TODO buy the ticket
		TODO check the ticket has been bought
		*/
	}

	private function registerMembership() 
	{
		$this->webDriver->get($this->baseUrl . '/index.php/account/my-membership/memberregistration');

		/*
		Many default exist, so we only need to change a few things
		TODO add all the field when we want to test them (and put this method somewhere else)
		*/
		$tel = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_tel'));
		$econtact = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_econtact'));
		$enumber = $this->webDriver->findElement(WebDriverBy::cssSelector('#jform_enumber'));
		$button = $this->webDriver->findElement(WebDriverBy::xpath('//button[text()="Submit"]'));

		$tel->sendKeys('00000000000');
		$econtact->sendKeys('imacontact');
		$enumber->sendKeys('00000000000');

		$button->click();
		/*
		TODO add assertion for page redirect
		TODO FIXME this currently redirects to a dead page?
		*/
	}
}
