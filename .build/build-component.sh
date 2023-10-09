#!/bin/bash
# Create a built .ZIP file that can be deployed to production

# Cleanup and setup
rm -f com_swa.zip
mkdir -p ./.build/output-component/administrator
mkdir -p ./.build/output-component/site

# Copy the code we are zipping into a tmp dir and move some stuff around
echo "Copying files into temporary directories..."
cp -r ./src/administrator/* ./.build/output-component/administrator
cp -r ./src/site/* ./.build/output-component/site
mv ./.build/output-component/administrator/swa.xml ./.build/output-component/swa.xml
echo "Files copied successfully."

# Create a list of directories to zip
directories_to_zip=(
  ./.build/output-component/administrator
  ./.build/output-component/site
)

# Function to zip a directory
zip_directory() {
  local dir="$1"
  echo "Zipping directory: $dir..."
  zip -rq0 "${dir}.zip" "${dir}"/*
  echo "Directory zipped: $dir"
}

export -f zip_directory

# Use xargs to zip directories in parallel
echo "Zipping directories in parallel..."
printf "%s\n" "${directories_to_zip[@]}" | xargs -I {} -P $(nproc) -n 1 bash -c 'zip_directory "$1"' _ {}
echo "Directories zipped successfully."

# Merge the zip files into one
echo "Merging zip files into com_swa.zip..."
zip -qj com_swa.zip ./.build/output-component/*.zip
echo "Merged zip files into com_swa.zip successfully."

# Remove the temporary zip files
echo "Removing temporary zip files..."
rm -rf ./.build/output-component/*.zip
rm -rf ./.build/output-component
echo "Temporary zip files removed."
