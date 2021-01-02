<?php

namespace SWA\Test\Browser;

/**
 * Test for login with the provided test users.
 * Ensures that:
 *  - Login and Logout menu items appear at the correct time.
 *  - The view access plugin displays the club and org menus at the correct time.
 */
final class LoginAndMenuTest extends SWABrowserTestCase
{

	public function provideTestUserDetails()
	{
		yield [ self::$USER_ADMIN, self::$PASSWORD, [] ];
		yield [ self::$USER_JOHNSMITH, self::$PASSWORD, [] ];
		yield [ self::$USER_JANESMITH, self::$PASSWORD, [] ];
		yield [ self::$USER_MTHOMP, self::$PASSWORD, [] ];
		yield [ self::$USER_BENDOVER, self::$PASSWORD, [] ];
		yield [ self::$USER_COMMITTIE_SWA, self::$PASSWORD, [ 'org' ] ];
		yield [ self::$USER_UNIVERSITY_SWA, self::$PASSWORD, [ 'club' ] ];
	}

	/**
	 * @dataProvider provideTestUserDetails
	 */
	public function testUserLoginAndExpectedMenus( string $username, string $password, array $expectedMenus = [] )
	{
		$this->login($username, $password);

		// Check that the plugin shows us the correct menu items
		$this->assertEquals(
			in_array('org', $expectedMenus),
			$this->elementExists('#fav-nav > .favnav .nav a[href="/index.php/organisation/my-details"]'),
			"Failed to assert 'org' menu was in the correct state."
		);
		$this->assertEquals(
			in_array('club', $expectedMenus),
			$this->elementExists('#fav-nav > .favnav .nav a[href="/index.php/club/members"]'),
			"Failed to assert 'club' menu was in the correct state."
		);
	}
}
