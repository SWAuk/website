<?php

namespace SWA\Test\Browser;

final class TitleTest extends SWABrowserTestCase
{

	public function testTitle()
	{
		$this->webDriver->get($this->baseUrl);
		$this->assertEquals('Home', $this->webDriver->getTitle());
	}
}
