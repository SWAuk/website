<?php

/**
 * GIT -> Joomla Install
 *
 * This file allows you to copy changes from this git repo to a deployed version of the component!
 * This means that you can develop here and easily push to a live joomla install!
 *
 * The location of the joomlaRoot to copy from is taken from .joomlaRoot
 *     For example: X:\web\pub\joomla
 */
$joomlaRoot = trim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '.joomlaRoot'));
if ($joomlaRoot === false) {
	die('Please create a .joomlaRoot file.');
}

#Copy all files
recurse_copy( __DIR__ . '/src/site', $joomlaRoot . '/components/com_swa');

recurse_copy(__DIR__ . '/src/administrator', $joomlaRoot . '/administrator/components/com_swa');

#This file needs to be moved
rename(__DIR__ . '/src/swa.xml', __DIR__ . '/src/administrator/swa.xml');

echo "Done!";

/**
 * Taken from the doc page of copy
 * http://php.net/manual/en/function.copy.php#91010
 */
function recurse_copy($src, $dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while (false !== ( $file = readdir($dir))) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if (is_dir($src . '/' . $file)) {
				recurse_copy($src . '/' . $file, $dst . '/' . $file);
			} else {
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
