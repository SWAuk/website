<?php

namespace SWA\Test\Browser;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class SWABrowserTestCase extends TestCase
{
	private const HOST_DOCKER_INTERNAL = 'host.docker.internal';

	/**
	 * @var RemoteWebDriver
	 */
	protected $webDriver;

	/**
	 * @var string
	 */
	protected $baseUrl;

	private function hostExists( $host ) : bool
	{
		return gethostbyname($host) != $host;
	}

	private function detectSeleniumHost() : string
	{
		// TODO also make configurable
		// If test is being run in general docker container, expect to connect to the host.
		if ($this->hostExists(self::HOST_DOCKER_INTERNAL)) {
			return self::HOST_DOCKER_INTERNAL;
		}
		// If the magic internal host doesn't exist then localhost should suffice.
		return 'localhost';
	}

	private function setBaseUrl() : void
	{
		// TODO also make configurable
		// The default configuration for browser tests runs joomla and selenium in docker-compose, so this should work.
		$this->baseUrl = 'http://joomla:80';
	}

	private function setWebDriver() : void
	{
		$capabilities = DesiredCapabilities::chrome();
		$seleniumUrl = 'http://' . $this->detectSeleniumHost() . ':4444/wd/hub';
		$this->webDriver = RemoteWebDriver::create($seleniumUrl, $capabilities);
	}

	private function setWebDriverWithRetries( $attempts = 15 )
	{
		try{
			$attempts--;
			$this->setWebDriver();
		}
		catch (\TypeError $e){
			$failMsg = 'Argument 1 passed to Facebook\WebDriver\Remote\DesiredCapabilities::__construct() must be of the type array, null given';
			if (strstr($e->getMessage(), $failMsg)) {
				if ($attempts <= 0) {
					throw new \RuntimeException("Seemingly couldn't connect to selenium.");
				}
				sleep(2);
				$this->setWebDriverWithRetries($attempts);
			}
		}
	}

	public function setUp() : void
	{
		$this->setWebDriverWithRetries();
		 $this->setBaseUrl();
	}

	public function tearDown(): void
	{
		$this->webDriver->quit();
	}
}
