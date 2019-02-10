<?php

// Copy the logo from the live site
$liveLogo = "https://studentwindsurfing.co.uk/images/SWA_Vector.png";
$target = __DIR__ . '/.docker/www/images/SWA_Vector.png';
file_put_contents($target, fopen($liveLogo, 'r'));

// Copy the background from the list site
$liveBackground = "https://studentwindsurfing.co.uk/images/FavouriteTemplate/body.jpg";
$target = __DIR__ . '/.docker/www/images/FavouriteTemplate/body.jpg';
file_put_contents($target, fopen($liveBackground, 'r'));

// Copy the default config into the Joomla install
copy( __DIR__ . '/.docker/configuration.php', __DIR__ . '/.docker/www/configuration.php' );
