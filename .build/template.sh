#!/bin/bash
# Fetch the template that we use in production for them development environment to use.

echo 'Fetching latest template'

# We use the free [FavThemes Favourite](https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template) template.
# SWA folks can [download a cached version](https://drive.google.com/file/d/1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK/view) from our shared drive.

# Download the file from drive
# https://www.matthuisman.nz/2019/01/download-google-drive-files-wget-curl.html
export fileid=1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK
curl --progress-bar -L -o favourite.zip 'https://docs.google.com/uc?export=download&id='$fileid

rm -rf ./.docker/www/templates/favourite
mkdir -p ./.docker/www/templates/favourite
echo "Unzipping:"
unzip favourite.zip -d ./.docker/www/templates | awk 'BEGIN {ORS=" "} {if(NR%1==0)print "."}'
echo ""
rm favourite.zip
