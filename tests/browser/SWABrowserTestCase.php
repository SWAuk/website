<?php

namespace SWA\Test\Browser;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

/**
 * This abstract test case should be used by all browser tests.
 */
abstract class SWABrowserTestCase extends TestCase
{
	use UserTrait;

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

	/**
	 * Set a WebDriver instance with a bunch of retries.
	 * The retries are here just incase selenium or the browser are not actually ready yet.
	 * By default wait at most 15*2=30 seconds.
	 */
	private function setWebDriverWithRetries( $attempts = 15 )
	{
		try{
			$attempts--;
			$this->setWebDriver();
		}
		catch (\TypeError $e){
			// If selenium doesn't return a proper response, this is the error state we end up in, as argument 1 would have come from the response.
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

	protected function elementExists( string $cssSelector ) : bool
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

}
