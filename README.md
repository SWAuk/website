# SWA

This repository contains a [Joomla component](https://docs.joomla.org/Component) that contains most of the logic for the [Student Windsurfing Association website](https://www.studentwindsurfing.co.uk/).

## Use

* docker-compose up (-d to do detached)
* docker-compose ps (to check it is there and running)
* docker-compose down (--volume to also remove SQL data in docker volume)

### Keeping the git repo and Joomla install synchronized

The Joomla install from the joomla docker container is mounted to `.docker/www/`. This directory is (rightly) ignored by git. Any changes done in `.docker/www/` are not reflected in the `src/` folder (which is tracked by git) and vice versa.

To help with this problem there are the `copyIn.php` and `copyOut.php` scripts. As the name suggest, `copyIn.php` copies changes from the Joomla install (`.docker/www/`) to the `src/` folder **IN** the git repo. While `copyOut.php` copies changes from the `src/` folder in the git repo **OUT** to the Joomla install (`.docker/www/`). It does this by watching for file changes.

**DO NOT TRY AND USE BOTH SCRIPTS AT THE SAME TIME OR YOU WILL GET INTO AN INFINATE LOOP!**

#### Example

I prefer to work in the `src/` folder in the git repo as it is allows you to checkout different git branches (e.g. to review a pull request) and have the changes synced to the Joomla install (`.docker/www/`). There are also less files and folders to navigate around. I'll therefore use `copyOut.php` in this example.

You could run these php scripts using a php interpreter installed on your machine but given that we have php with the `util` container I'm going to use that. NOTE: I run two commands in the example below. `docker-compose run --rm util` to get a shell inside the `util` container and `php copyOut.php` inside the `util` container.

```
$ docker-compose run --rm util
root@93cbded36147:/swa# php copyOut.php
Lurking...
```

If I make a change in `src/site/views/events/tmpl/default.php` and save it you will see that the change has been picked up and the contents of `src/site` is copied to the Joomla install (`.docker/www`):

```
$ docker-compose run --rm util
root@93cbded36147:/swa# php copyOut.php
Lurking...
Copying site...
Done!
```

The same will happen if you make a change in `src/administrator`.

It is advised to start the `copyOut.php` (or `copyIn.php`) script *before* making any changes. If you forget then you will need to run the script and make a trivial change to any file in the directory you've been working in (i.e. `src/site/` or `src/administrator/`) for the script to register a change and do the copy.

## First setup


#### Clone this repo

``` git clone https://github.com/SWAuk/com_swa.git```
 * Copy `.env.example` to `.env` (edit the defaults if you want to)
 ``` cp .env.example .env ```

#### Install required programs

 * [Docker](https://docs.docker.com/install/)
 * [docker-compose](https://docs.docker.com/compose/install/)

#### Install required libraries

[`composer`](https://getcomposer.org/) is a dependency manager for PHP. Use it to install the PHP libraries needed for test, development and production.
As docker is already required, the easiest way to use `composer` to install the required libs is via the official [docker image](https://hub.docker.com/_/composer).
##### On Linux (or Git Bash for Windows) run:

```
docker run --rm -it -v $PWD:/app composer install
```

##### On Windows (i.e. CMD) run:

```
docker run --rm -it -v %CD%:/app composer install
```

#### Launch services

```docker-compose up -d```

#### Download Template Zip

We use the free [FavThemes Favourite](https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template) template. \
(SWA Committee can [download a cached version](https://drive.google.com/file/d/1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK/view) from our shared drive.) \
Put the zip in the root directory of this repo (it will be ignored by git)

#### Run firstSetup script

This copies various files into the right places in the Joomla `/www`.\
``` docker-compose run --rm --entrypoint php util firstSetup.php ```\
(You can also run the firstSetup script locally if php installed.)

#### Installing the SWA component in Joomla

* Create a zip of the component:\
``` docker-compose run --rm --entrypoint php util make.php ```

* Go to the Joomla backend, http://localhost:5555/administrator
* Log in (admin:password)
* Top menu, Extensions >> Manage >> Install
* Select "Upload package from file"
* Upload the com_swa.zip file that was created in the root repo folder


#### Installing the SWA AccessList plugin in joomla

* Download the latest Zip:\
https://github.com/SWAuk/plg_swa_viewlevels/releases
* Drag and drop it into the "Upload Package from file" as above.
* Enable the plugin in the Extensions >> Plugins
* In the `/.docker/www/libraries/src/Access/Access.php` file, \
add the code snippet from https://github.com/SWAuk/plg_swa_viewlevels

### Access

The default things will be here (unless you changed them in your .env file)

* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator
* Adminer: http://localhost:5556 (user: root, password: example)


### Template notes

The original template sources is https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template
A copy of this can be found on the SWA Drive "Tech/Web Dev/Templates/favourite_j!3_UnzipFirst.zip"

### Plugins

You will need to install these plugins to reach parity with the live site

* Folcomedia - Cookies Alert
