#!/bin/bash

echo "$(tput setaf 3)Building JS Files$(tput sgr0)"

# Find all .js files in ./assets and ./assets/js, excluding those ending with .min.js
find ./assets ./assets/js -type f -name '*.js' ! -name '*.min.js' | while read -r f; do
  file=${f%.js}
  echo "$(tput setaf 3)Building $f$(tput sgr0)"
  node_modules/.bin/uglifyjs "$f" -c -m -o "$file.min.js"
done
