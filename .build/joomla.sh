#!/bin/bash
# Download the appropriate version of Joomla from Github that we want to develop against.
# This should generally be kept in sync with what is running in production.

echo 'Fetching Joomla'
echo 'Sorry this is a bit slow currently...'
# TODO make it skip the download if we already have the right version..

# New version tags can be gotten from https://github.com/joomla/joomla-cms/releases
curl --progress-bar -L -o joomla.zip 'https://github.com/joomla/joomla-cms/archive/3.9.23.zip'

rm -rf ./.docker/www
mkdir -p ./.docker/www

unzip -q joomla.zip -d ./.docker/www
mv ./.docker/www/*/* ./.docker/www/

rm -rf ./.docker/www/installation
rm -rf ./.docker/www/joomla-cms-*
rm joomla.zip
