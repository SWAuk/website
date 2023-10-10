#!/bin/bash
# Create a built .ZIP file that can be deployed to prodction

# Cleanup and setup
rm -rf plg_swa_viewlevels.zip
mkdir -p ./.build/output-plugin

# Copy the code we are zipping into a tmp dir
cp -r ./src/plugin/ ./.build/output-plugin

# Zip it up correctly
cd ./.build/output-plugin/ ; zip -r ./../../plg_swa_viewlevels.zip ./* ; cd ../..

# Remove the temporary files
rm -rf ./.build/output-plugin
