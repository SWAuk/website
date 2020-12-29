echo 'Fetching latest template'

# We use the free [FavThemes Favourite](https://www.favthemes.com/joomla-templates/product/favourite-free-responsive-joomla-3-template) template.
# SWA folks can [download a cached version](https://drive.google.com/file/d/1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK/view) from our shared drive.

# Download the file from drive
# https://www.matthuisman.nz/2019/01/download-google-drive-files-wget-curl.html
export fileid=1IoYZcvmlIyUrFKyh96wWWJgff5qbhdjK
curl -s -L -o favourite.zip 'https://docs.google.com/uc?export=download&id='$fileid

rm -rf ./.docker/www/templates/favourite
mkdir -p ./.docker/www/templates/favourite
unzip -q favourite.zip -d ./.docker/www/templates
rm favourite.zip
