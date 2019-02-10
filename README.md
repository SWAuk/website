SWA
==================

Student Windsurfing Association website stuff.

## Use

### Initial Setup

 * [Install Docker](https://docs.docker.com/install/)
 * [Install docker-compose](https://docs.docker.com/compose/install/)
 * Copy .env.example to .env (edit the defaults if you want to)

### Running stuff

* docker-compose up (-d to do detached)
* docker-compose ps (to check it is there and running)

### Building a zip of the component

One liner:
```
$ docker-compose run --entrypoint php util make.php
Ziping all...
Done /swa/com_swa.zip
```

Or multi liner:

```
$ docker-compose run util
root@b32311e59b3f:/swa# php ./make.php
Ziping all...
Done /swa/com_swa.zip
```

Or locally:
* Figure it out yourself...

### Installing the component in Joomla

* Go to the Joomla backend, http://localhost:5555/administrator
* Log in
* Top menu, Extension >> Manage >> Install
* Select "Upload package from file"
* Upload the Zip

### Add the template that we use

Add the template to the Joomla install

* Download the zip of the pre installed template from https://drive.google.com/file/d/1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK/view
* Add the template to .docker/www/templates/favourite

The original template sources is https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template
A copy of this can be found on the SWA Drive "Tech/Web Dev/Templates/favourite_j!3_UnzipFirst.zip"

### First setup changes

One liner:
```
$ docker-compose run --entrypoint php util firstSetup.php
```

You can also run this not in docker


### Access

The default things will be here (unless you changed them in your .env file)

* Joomla front: http://localhost:5555
* Joomla back: http://localhost:5555/administrator
* Adminer: http://localhost:5556 (user: root, password: example)
