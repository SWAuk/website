SWA
==================

Student Windsurfing Association website stuff.

## Use

### Initial Setup

 * Install Docker
 * Install docker-compose
 * Copy .env.example to .env (edit it if you want to)

### Running stuff

* docker-compose up (-d to do detached)
* docker-compose ps (to check it is there and running)

### Building a zip of the component

* docker-compose run util (to get a bash shell with php installed)
* php make.php (in the util container, to make a zip of code to load into Joomla )
* This zip can then be loaded into Joomla using the backend.

### Access

The default things will be here (unless you changed them in your .env file)

Joomla front: http://localhost:5555
Joomla backe: http://localhost:5555/administrator
Adminer: http://localhost:5556
