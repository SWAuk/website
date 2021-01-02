#!/bin/bash
# Automatically add the custom event needed for the swa view levels plugin.

accessFile="./.docker/www/libraries/src/Access/Access.php"

# If we have a fresh file (without the hack) then take a backup...
if ! grep -q "START HACK for plg_swa_viewlevels" $accessFile; then
	# No hack in the file yet
	cp $accessFile $accessFile.backup
fi

echo "Installing plugin hack to $accessFile"

# Use our backup file as a base
cp $accessFile.backup $accessFile

# Find the start of the function using a simple grep
functionStart="$(cat $accessFile | grep -n "public static function getAuthorisedViewLevels" | head -n 1 | cut -d: -f1)"
# Find the final return of the function using an offsent and exptected indentiations
functionFinalReturnOffset="$(cat $accessFile | tail --lines=+$functionStart | grep -n "^[[:space:]][[:space:]]return \$authorised;" | head -n 1 | cut -d: -f1)"
# Calculate the actual line number of the final return
functionFinalReturn="$(($functionStart-1+$functionFinalReturnOffset))"

# Insert the lines that we need (reversed)
sed -i "$functionFinalReturn i\// END HACK for plg_swa_viewlevels" $accessFile
sed -i "$functionFinalReturn i\require __DIR__ . '/../../../plugins/swa/viewlevels/eventsnippet.php';" $accessFile
sed -i "$functionFinalReturn i\// START HACK for plg_swa_viewlevels" $accessFile
