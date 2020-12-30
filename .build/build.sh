#!/bin/bash
# Create a built .ZIP file that can be deployed to proudction

# Cleanup and setup
rm -rf com_swa.zip
mkdir -p ./.build/tmp-build

# Copy the code we are zipping into a tmp dir and move some stuff around
cp -r ./src/* ./.build/tmp-build
mv ./.build/tmp-build/administrator/swa.xml ./.build/tmp-build/swa.xml

# Zip it up correctly
cd ./.build/tmp-build/ ; zip -r ./../../com_swa.zip ./* ; cd ../..

# Remove the temporary files
rm -rf ./.build/tmp-build
