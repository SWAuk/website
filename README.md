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

## Development Environment

The recommended dev environment uses docker-compose.

The general cheat sheet is below, but you'll need to do some other things for your first setup...

* `docker-compose up` (-d to do detached)
* `docker-compose ps` (to check it is there and running)
* `docker-compose down` (--volume to also remove SQL data in docker volume)

The default things will be here (unless you changed them in your .env file)

* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator (user: admin, password: password)
* Adminer: http://localhost:5556 (user: root, password: example)

### Install required programs

* [Docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/install/)
* [composer](https://getcomposer.org/download/) - A PHP package manager

You can also run **composer in docker**...

For linux and bashy systems that would be:

```sh
docker run --rm -it -v $PWD:/app composer <command here>
```

If you are on windows using CMD that would be:

```sh
docker run --rm -it -v %CD%:/app composer <command here>
```

### Install required libraries and things

[`composer`](https://getcomposer.org/) is a dependency manager for PHP.
Use it to install the PHP libraries needed for test, development and production.
As docker is already required, the easiest way to use `composer` to install the required libs is via the official [docker image](https://hub.docker.com/_/composer).

This step:

* Downloads various PHP packages for our component.
* Downloads the Template that the SWA site uses.
* Downloads various images and logos.

To run the step:

```sh
composer install
```

### Launch services

```sh
docker-compose up -d
```

### Other Plugins

You will need to install these plugins to reach parity with the live site

* Folcomedia - Cookies Alert
