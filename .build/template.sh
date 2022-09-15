#!/bin/bash
# Fetch the template that we use in production for them development environment to use.

echo 'Fetching latest template'

# As something has changed for downloading drive files, the template is now encrypted using 7Zip purely for its AES 256 CBC encryption.


# We use the free [FavThemes Favourite](https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template) template.
# SWA folks can [download a cached version](https://drive.google.com/file/d/1L0nNcbBnHM1pxfUOmCKSCX1BF7hZOAea/view) from our shared drive.
# The encrypted version to be used here is at, https://drive.google.com/file/d/13gIz0RuwZDVffNu_Cjpz2qntkM0fkdW5/view?usp=sharing
# The password hint is; Taffys real name, in lowercase
# Download the file from drive
# https://www.matthuisman.nz/2019/01/download-google-drive-files-wget-curl.html
export fileid=13gIz0RuwZDVffNu_Cjpz2qntkM0fkdW5
curl --progress-bar -L -o favourite.tar.7z 'https://docs.google.com/uc?export=download&id='$fileid
7z x favourite.tar.7z -p${TAFFYS_NAME}

rm -rf ./.docker/www/templates/favourite
mkdir -p ./.docker/www/templates/favourite

echo "Unzipping:"
tar xf favourite.tar -C ./.docker/www/templates
echo ""
rm favourite.tar.7z
rm favourite.tar
