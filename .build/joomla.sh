#!/bin/bash
# Download the appropriate version of Joomla from Github that we want to develop against.
# This should generally be kept in sync with what is running in production.

# New version tags can be gotten from https://github.com/joomla/joomla-cms/releases
export joomtoget="https://github.com/joomla/joomla-cms/archive/3.9.23.zip"
touch .joomgot

# Only download Joomla if we havn't already got it
if grep -q $joomtoget .joomgot; then
  if test -f "./.docker/www/index.php"; then
    echo 'Skiping Joomla fetch, as current version seems up to date...'
    echo 'If you need to force a refetch then delete the .joomgot file'
    exit 0
  fi
fi

echo 'Fetching Joomla'

curl --progress-bar -L -o joomla.zip $joomtoget

rm -rf ./.docker/www
mkdir -p ./.docker/www

echo "Unzipping:"
unzip joomla.zip -d ./.docker/www | awk 'BEGIN {ORS=" "} {if(NR%10==0)print "."}'
echo ""
mv ./.docker/www/*/* ./.docker/www/

rm -rf ./.docker/www/installation
rm -rf ./.docker/www/joomla-cms-*
rm joomla.zip

echo $joomtoget > .joomgot
