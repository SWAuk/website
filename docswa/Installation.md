[[SWA Website Repository]]
## Requirements (Tools)
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


## Installing the web server locally
For each install step, we will run a composer command on the docker image. The templates are below. They will be referenced by \<template\>

```sh

docker run --env-file ./.env --rm -it -v $PWD:/app composer <command here>

```
If you are on windows using CMD that would be:
```sh

docker run --env-file ./.env --rm -it -v %CD%:/app composer <command here>

```

1. Copy and fill in [[..\.env]]
>**Note**: The password to decrypt the template is Taffys first name.
3. \<template\> install
4. Install p7zip, so that the template can be installed.
	1. ```docker-compose exec joomla /bin/bash -c "apt-get update && apt-get -y install p7zip*```

If you are having issues with installing dependency versions, use the following command:

```sh
docker run --env-file ./.env --rm -it -v %CD%:/app composer install --ignore-platform-reqs
```

If you are having issues with `post-update-cmd`, use the following command:

```sh
git clone -c core.autocrlf=false https://github.com/SWAuk/website.git
```

If everything installs correctly, run `docker compose up -d` 
Other useful docker commands:
* `docker-compose up` (-d to do detached)
* `docker-compose ps` (to check it is there and running)
* `docker-compose down` (--volume to also remove SQL data in docker volume)

The default things will be here (unless you changed them in your .env file)
* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator (user: admin, password: password)
* Adminer: http://localhost:5556 (user: root, password: example)


Joomla is populated with a sample SWA data set, this is done in `./.docker/db/initdb/init.sql`.
This data set includes some example users, all of their passwords are `password`

### Test Users
 
* admin - Super User - membership but no tickket
* johnsmith - membership not paid, has ticket
* janesmith
* mthomp
* bendover - already has mebership and ticket to Best Event
* swacom
* unicom

### Other Plugins
You will need to install these plugins to reach parity with the live site [[Core Plugins]]

> If you are having issues installing plugins or changing settings, go to **System Information->Permissions**

> You want all of these to be green! If there are any not green, navigate to the html directory, and run this command `chmod -R o+w DIRNAME`


[[Testing]]
[[GitHub Actions]]