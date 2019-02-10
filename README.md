SWA
==================

Student Windsurfing Association website stuff.

## Use
* docker-compose up (-d to do detached)
* docker-compose ps (to check it is there and running)
* docker-compose down (--volume to also remove SQL data in docker volume)


### First setup

##### Clone this repo
``` git clone https://github.com/SWAuk/com_swa.git```
 * Copy `.env.example` to `.env` (edit the defaults if you want to)

##### Install requirements
 * [Docker](https://docs.docker.com/install/)
 * [docker-compose](https://docs.docker.com/compose/install/)

##### Launch services
```docker-compose up -d```

##### Download Template Zip
Download from https://drive.google.com/file/d/1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK/view
and put in this directory (it will be ignored by git)

##### Run firstSetup script
This copies various files into the right places in the Joomla www.
```
$ docker-compose run --entrypoint php util firstSetup.php
```
(You can also run the firstSetup script locally if php installed.)

##### Installing the SWA component in Joomla

* Create a zip of the component:
```
$ docker-compose run --entrypoint php util make.php
```

* Go to the Joomla backend, http://localhost:5555/administrator
* Log in
* Top menu, Extension >> Manage >> Install
* Select "Upload package from file"
* Upload the Zip


### Access
The default things will be here (unless you changed them in your .env file)

* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator
* Adminer: http://localhost:5556 (user: root, password: example)


### Template notes
The original template sources is https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template
A copy of this can be found on the SWA Drive "Tech/Web Dev/Templates/favourite_j!3_UnzipFirst.zip"
