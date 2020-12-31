<?php

namespace SWA\Test\Browser;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class SWABrowserTestCase extends TestCase
{
	/**
	 * @var RemoteWebDriver
	 */
	protected $webDriver;

	/**
	 * TODO make configurable for different users?
	 * @var string
	 */
	protected $baseUrl = 'http://host.docker.internal:5555';

	public function getCapabilities()
    {
		$capabilities = DesiredCapabilities::chrome();
		return $capabilities;
	}

	public function setUp() : void
    {
		$capabilities = $this->getCapabilities();
		// Connect to the remote webdriver that is served via docker
		$this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
	}

	public function tearDown(): void
    {
		$this->webDriver->quit();
	}
}
