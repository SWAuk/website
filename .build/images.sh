echo 'Fetching images'

rm -rf ./.docker/www/images
mkdir -p ./.docker/www/images
mkdir -p ./.docker/www/images/FavouriteTemplate

curl -L --progress-bar -o ./.docker/www/images/SWA_Vector.png 'https://studentwindsurfing.co.uk/images/SWA_Vector.png'
curl -L --progress-bar -o ./.docker/www/images/FavouriteTemplate/body.jpg 'https://studentwindsurfing.co.uk/images/FavouriteTemplate/body.jpg'
