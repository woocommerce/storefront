#!/bin/bash

# Initialize the error flag
error_flag=0

# Define the base directory to check
base_dir="./assets"

# Check if the base directory exists
if [ ! -d "$base_dir" ]; then
  echo "Error: The directory $base_dir does not exist."
  exit 1
fi

# Function to check for corresponding .min.js file
check_for_min_js() {
  local js_file="$1"
  local min_js_file="${js_file%.js}.min.js"
  if [ ! -f "$min_js_file" ]; then
    echo "Error: No corresponding .min.js file found for $js_file"
    return 1
  fi
  return 0
}

# Find all .js files within the base directory (excluding .min.js files)
while IFS= read -r -d '' js_file; do
  if ! check_for_min_js "$js_file"; then
    error_flag=1
  fi
done < <(find "$base_dir" -type f -name "*.js" ! -name "*.min.js" -print0)

# Exit with an error code if any .js file is missing its corresponding .min.js file
if [ "$error_flag" -ne 0 ]; then
  echo "Error: the ZIP could not be built because minified scripts are missing. Please ensure you are using the correct versions of NPM and Node.js."
  exit 1
else
  echo "All .js files within $base_dir have corresponding .min.js files."
  exit 0
fi
