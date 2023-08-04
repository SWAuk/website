### Browser tests
The Browser tests can be run entirely in docker against the development environment Joomla install. In order to start the extra containers needed run:

```sh
docker-compose -f docker-compose-selenium.yml up
```
You should then be able to run the tests using:

```sh
composer phpunit:browser
```

The browser test setup includes a container that will record a video while the containers are running. You will NOT be able to view this video until the containers are stopped (and the video file is no longer being written to).

**WARNING:** leaving this container running for a long time will slowly eat up your disk space.

To stop the browser test related containers run:
```sh
docker-compose -f docker-compose-selenium.yml down
```
You should then be able to see a video of the browser in `.docker/selenium/videos`.