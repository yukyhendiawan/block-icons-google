#!/bin/bash

# Path to your files
PLUGIN_FILE="block-icons.php"
README_FILE="README.txt"
CHANGELOG_FILE="CHANGELOG.md"

# Extract the new version from package.json using Node.js
NEW_VERSION=$(node -pe "require('./package.json').version")

# Check if version is empty
if [ -z "$NEW_VERSION" ]; then
  echo "Error: Version is empty. Please check your package.json file."
  exit 1
fi

# Debugging: Print the new version
echo "Extracted version: $NEW_VERSION"

# Update the version in the plugin file
# Handle various spacing by making the regex more flexible
if sed -i -E "s/^(\s*\*\s*Version:\s*)[0-9]+\.[0-9]+\.[0-9]+/\1$NEW_VERSION/" "$PLUGIN_FILE"; then
  echo "Successfully updated the Version header in $PLUGIN_FILE"
else
  echo "Failed to update the Version header in $PLUGIN_FILE"
  exit 1
fi

# Update the define statement
if sed -i -E "s/define\(\s*'BLOCK_ICONS_VERSION',\s*'[^']*'\s*\);/define( 'BLOCK_ICONS_VERSION', '$NEW_VERSION' );/" "$PLUGIN_FILE"; then
  echo "Successfully updated the BLOCK_ICONS_VERSION define statement in $PLUGIN_FILE"
else
  echo "Failed to update the BLOCK_ICONS_VERSION define statement in $PLUGIN_FILE"
  exit 1
fi

# Update the Stable tag in the README.txt file
if sed -i -E "s/^(\s*Stable tag:\s*)[0-9]+\.[0-9]+\.[0-9]+/\1$NEW_VERSION/" "$README_FILE"; then
  echo "Successfully updated the Stable tag in $README_FILE"
else
  echo "Failed to update the Stable tag in $README_FILE"
  exit 1
fi

# Read the content of the CHANGELOG.md file and format it
# CHANGELOG_CONTENT=$(cat "$CHANGELOG_FILE" | sed '/^$/d' | sed 's/^\(#\{1,\} \)/\n\1/g')

# # Update the Changelog section in the README.txt file
# # Remove the existing Changelog content first
# sed -i '/== Changelog ==/,/== Upgrade Notice ==/d' "$README_FILE"

# # Append the new Changelog content
# {
#   echo "== Changelog =="
#   echo "$CHANGELOG_CONTENT"
#   echo ""
#   echo "== Upgrade Notice =="
# } >> "$README_FILE"

# if [ $? -eq 0 ]; then
#   echo "Successfully updated the Changelog section in $README_FILE"
# else
#   echo "Failed to update the Changelog section in $README_FILE"
#   exit 1
# fi

echo "Updated plugin version to $NEW_VERSION"