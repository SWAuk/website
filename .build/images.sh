#!/bin/bash
# In order to make the dev site look even better we need to grab a few files from production :)

echo 'Fetching images'

curl -L --progress-bar -o ./.docker/www/images/SWA_Vector.png 'https://studentwindsurfing.co.uk/images/SWA_Vector.png'

mkdir -p ./.docker/www/images/FavouriteTemplate
curl -L --progress-bar -o ./.docker/www/images/FavouriteTemplate/body.jpg 'https://studentwindsurfing.co.uk/images/FavouriteTemplate/body.jpg'
