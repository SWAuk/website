<?php


function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object);
       }
     }
     rmdir($dir);
   }
 }


$zip = new ZipArchive;
$res = $zip->open(__DIR__ . '/favourite.zip');
if ($res === TRUE) {
	$zip->extractTo(__DIR__ . '/.docker/www/templates/');
	$zip->close();
	echo 'Template extracted' . "\n";
} else {
	die( 'Template extraction failed...' );
}

echo "Fetching Logo and background image\n";
mkdir(__DIR__ . '/.docker/www/images/FavouriteTemplate', 0777, True);

// Copy the logo from the live site
$liveLogo = "https://studentwindsurfing.co.uk/images/SWA_Vector.png";
$target = __DIR__ . '/.docker/www/images/SWA_Vector.png';
file_put_contents($target, fopen($liveLogo, 'r'));

// Copy the background from the list site
$liveBackground = "https://studentwindsurfing.co.uk/images/FavouriteTemplate/body.jpg";
$target = __DIR__ . '/.docker/www/images/FavouriteTemplate/body.jpg';
file_put_contents($target, fopen($liveBackground, 'r'));


// Copy the default config into the Joomla install
echo "Adding default Joomla config\n";
copy( __DIR__ . '/.docker/configuration.php', __DIR__ . '/.docker/www/configuration.php' );


// Rmove the default /installation folder
echo "Removing Joomla Installation folder\n";
rrmdir(__DIR__ . '/.docker/www/installation');

echo "Done!";
