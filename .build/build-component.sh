#!/bin/bash
# Create a built .ZIP file that can be deployed to prodction

# Cleanup and setup
rm -rf com_swa.zip
mkdir -p ./.build/output-component/administrator
mkdir -p ./.build/output-component/site

# Copy the code we are zipping into a tmp dir and move some stuff around
cp -r ./src/administrator/* ./.build/output-component/administrator
cp -r ./src/site/* ./.build/output-component/site
mv ./.build/output-component/administrator/swa.xml ./.build/output-component/swa.xml

# Zip it up correctly
cd ./.build/output-component/ ; zip -r ./../../com_swa.zip ./* ; cd ../..

# Remove the temporary files

rm -rf ./.build/output-component
