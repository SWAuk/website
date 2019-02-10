<?php

$liveLogo = "https://studentwindsurfing.co.uk/images/SWA_Vector.png";
$target = __DIR__ . '/.docker/www/images/SWA_Vector.png';

file_put_contents($target, fopen($liveLogo, 'r'));
