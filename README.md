# SWA

This repository contains a [Joomla component](https://docs.joomla.org/Component) that contains most of the logic for the [Student Windsurfing Association website](https://www.studentwindsurfing.co.uk/).

## Production (live site)

### Installing the SWA component in Joomla

* Create a zip of the component using the `composer run build` command.
* Go to the Joomla backend, http://localhost:5555/administrator
* Log in (admin:password)
* Top menu, Extensions >> Manage >> Install
* Select "Upload package from file"
* Upload the com_swa.zip file that was created in the root repo folder

### Installing the SWA AccessList plugin in joomla

* Download the latest Zip:\
https://github.com/SWAuk/plg_swa_viewlevels/releases
* Drag and drop it into the "Upload Package from file" as above.
* Enable the plugin in the Extensions >> Plugins
* In the `/.docker/www/libraries/src/Access/Access.php` file, \
add the code snippet from https://github.com/SWAuk/plg_swa_viewlevels

### Template notes

The original template sources is https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template
A copy of this can be found on the SWA Drive "Tech/Web Dev/Templates/favourite_j!3_UnzipFirst.zip"

## Development - Dependencies

### docker & docker-compose

To make your life easy you can run many things related to development in docker.

To do so you would need to install the following:

* [Docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/install/)

**Note:** It is possible to develop without docker.

### composer

In order to install the needed packages for development you'll need [composer](https://getcomposer.org/download/).
Composer is a dependency manager and command runner for PHP.

Use it to install the PHP libraries needed for testing, development and production.

The easiest way to use `composer` to install the required libs is via the official [docker image](https://hub.docker.com/_/composer).

For linux and bashy systems that would be:

```sh
docker run --rm -it -v $PWD:/app composer <command here>
```

If you are on windows using CMD that would be:

```sh
docker run --rm -it -v %CD%:/app composer <command here>
```

### Install composer dependencies

```sh
composer install
```

## Development - Environment

The recommended dev environment uses docker-compose.

The general cheat sheet is below, but you'll need to do some other things for your first setup...

* `docker-compose up` (-d to do detached)
* `docker-compose ps` (to check it is there and running)
* `docker-compose down` (--volume to also remove SQL data in docker volume)

The default things will be here (unless you changed them in your .env file)

* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator (user: admin, password: password)
* Adminer: http://localhost:5556 (user: root, password: example)

Joomla is populated with a sample SWA data set, this is done in `./.docker/db/initdb/init.sql`.
This data set includes some example users, all of their passwords are `password`

* admin - Super User
* johnsmith
* janesmith
* mthomp
* bendover
* swacom
* unicom

### Launch services

```sh
docker-compose up -d
```

### Other Plugins

You will need to install these plugins to reach parity with the live site

* Folcomedia - Cookies Alert

## Development - Tests

Many tests are runable via composer commands.
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

These individual commands are combined in a few usefull meta commands.

To run all fixers just run:

```sh
composer fix
```

To run all all basic linters and tests (excludes browser tests) run:

```sh
composer ci
```

### Browser tests

The Browser tests can be run entirely in docker against the development environment Joomla install.

In order to start the extra containers needed run:

```sh
docker-compose -f docker-compose-selenium.yml up
```

You should then be able to run the tests using:

```sh
composer phpunit:browser
```

The browser test setup includes a container that will record a video while the containers are running.
You will NOT be able to view this video until the containers are stopped (and the video file is no longer being written to).

**WARNING:** leaving this container running for a long time will slowly eat up your disk space.

To stop the browser test related containers run:

```sh
docker-compose -f docker-compose-selenium.yml down
```

You should then be able to see a video of the browser in `.docker/selenium/videos`.

### Github Actions

[Github Actions](https://github.com/features/actions) is used for continuous integration for this repository.

The configuration for the actions can be found in `.github/workflows`.

The CI currently runs on all PRs and merges into the master branch.
