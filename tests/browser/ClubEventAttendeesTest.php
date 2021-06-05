<?php

namespace SWA\Test\Browser;

use PHP\WebDriver\WebDriverBy;

final class ClubEventAttendeesTest extends SWABrowserTestCase
{

	public function testUniversityNameIsInTitle()
	{
		$this->login(self::$USER_UNIVERSITY_SWA, self::$PASSWORD);

		$this->webDriver->get($this->baseUrl . '/index.php/club/event-attendees');

		$contentTitle = $this->webDriver->findElement(WebDriverBy::cssSelector('#fav-maincontent > h1'));

		$this->assertEquals('University1 Event Attendees', $contentTitle->getText());
	}
}
