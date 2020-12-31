<?php

namespace SWA\Test\Browser;

final class TitleTest extends SWABrowserTestCase
{

	public function testTitle()
	{
		$this->webDriver->get($this->baseUrl);
		$fail = "Title check failed for baseUrl " . $this->baseUrl . PHP_EOL .
		"On page: " . $this->webDriver->getCurrentURL() . PHP_EOL .
        'With source: ' . $this->webDriver->getPageSource() . PHP_EOL;
		$this->assertEquals('Home', $this->webDriver->getTitle(), $fail);
	}
}
