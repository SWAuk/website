<?php

namespace SWA\Test\Browser;

final class HomeTest extends SWABrowserTestCase
{

	public function testTitle()
	{
		$this->webDriver->get($this->baseUrl);
		$this->assertEquals('Home', $this->webDriver->getTitle());
	}
}
