#!/bin/bash
# We need to move the files that we use from the stripe library in vendor into our actual application.
# This is because the vendor directory of com_swa is not actually loaded into the package for Joomla.

echo 'Moving stripe into our src directory'

# Remove anything that already exists
rm -rf ./src/site/libraries/stripe/*

# Make a fresh directory
mkdir -p ./src/site/libraries/stripe

# Copy the bits we want
cp ./vendor/stripe/stripe-php/init.php ./src/site/libraries/stripe/init.php
cp -r ./vendor/stripe/stripe-php/lib ./src/site/libraries/stripe/lib
cp -r ./vendor/stripe/stripe-php/data ./src/site/libraries/stripe/data
cp ./vendor/stripe/stripe-php/VERSION ./src/site/libraries/stripe/VERSION
