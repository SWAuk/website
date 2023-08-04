
Many tests are runnable via composer commands.
Have a look in `composer.json` to see what commands are available, or run `composer list`.

All of these tests are also run in [Github Actions](https://github.com/features/actions) for Pull Requests.
* **[minus-x](https://github.com/wikimedia/mediawiki-tools-minus-x)** - Removes executable flags from files that should not have them.
  * **minus-x:check** - Checks files listing issues.
  * **minus-x:fix** - Checks files fixing issues.
* **lint** - Runs a linter against PHP files.
* **phpcs** - Runs the [PHP Codesniffer](https://github.com/squizlabs/PHP_CodeSniffer), with a modified [Joomla ruleset](https://docs.joomla.org/Joomla_CodeSniffer) (see `.phpcs.xml`).
* **phpcbf** - Runs the PHP Code Beautifier and Fixer, which is part of PHP Codesniffer.
* **[phpunit](https://phpunit.de/)** - A testing framework for PHP.
	* **phpunit:unit** - Runs "unit" tests only, as defined in the `tests/unit` directory.
	* **phpunit:browser** - Runs "unit" tests only, as defined in the `tests/browser` directory. (requires additional setup, see below)
    * You can run individual tests using commands like `composer phpunit:browser -- --filter HomeTest`

These individual commands are combined in a few useful meta commands.

To run all fixers just run:

```sh
composer fix
```

To run all all basic linters and tests (excludes browser tests) run:
  

```sh
composer ci
```

  

[[Browser tests]]
