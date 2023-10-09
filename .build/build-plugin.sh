#!/bin/bash
# Create a built .ZIP file that can be deployed to production

# Cleanup and setup
echo "Cleaning up previous build artifacts..."
rm -f plg_swa_viewlevels.zip
mkdir -p ./.build/output-plugin

# Copy the code we are zipping into a tmp dir
echo "Copying plugin code into a temporary directory..."
cp -r ./src/plugin/ ./.build/output-plugin
echo "Plugin code copied successfully."

# Zip it up correctly
echo "Zipping the plugin code..."
cd ./.build/output-plugin/
zip -rq ./../../plg_swa_viewlevels.zip ./*
cd ../..
echo "Plugin code zipped successfully."

# Remove the temporary files
echo "Removing temporary files..."
rm -rf ./.build/output-plugin
echo "Temporary files removed."

echo "Build complete."
