SWA
==================

Student Windsurfing Association website stuff.

## Use
* docker-compose up (-d to do detached)
* docker-compose ps (to check it is there and running)
* docker-compose down (--volume to also remove SQL data in docker volume)


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
As docker is already required, the easiest way to use `composer` to install the requrired libs is via the official [docker image](https://hub.docker.com/_/composer).
##### On Linux run:
```
docker run --rm -it -v $PWD:/app composer install
```

##### On Windows run: 
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
