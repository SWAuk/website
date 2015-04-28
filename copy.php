<?php
/**
 * This file allows you to copy changes from a deployed version of the component
 * back to the git repo!
 * This means that you can develop on your live test code!
 *
 * The location of the joomlaRoot to copy from is taken from .joomlaRoot
 *     For example: X:\web\pub\joomla
 */
$joomlaRoot = file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . '.joomlaRoot' );
if( $joomlaRoot === false ) {
	die( 'Please create a .joomlaRoot file.' );
}

#Copy all files
recurse_copy(
	$joomlaRoot . '/components/com_swa',
	__DIR__ . '/src/site'
);
recurse_copy(
	$joomlaRoot . '/administrator/components/com_swa',
	__DIR__ . '/src/administrator'
);

#This file needs to be moved
rename(
	__DIR__ . '/src/administrator/swa.xml',
	__DIR__ . '/src/swa.xml'
);

echo "Done!";

/**
 * Taken from the doc page of copy
 * http://php.net/manual/en/function.copy.php#91010
 */
function recurse_copy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src . '/' . $file,$dst . '/' . $file);
			}
			else {
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
