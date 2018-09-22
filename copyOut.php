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

require_once __DIR__ . '/vendor/autoload.php';

use Lurker\Event\FilesystemEvent;
use Lurker\ResourceWatcher;

$watcher = new ResourceWatcher;
$watcher->track('administrator', __DIR__ . '/src/administrator' );
$watcher->track('site', __DIR__ . '/src/site' );
$watcher->track('swa.xml', __DIR__ . '/src/swa.xml' );

$joomlaRoot = __DIR__ . '/.docker/www';


$watcher->addListener('administrator', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying administrator...\n";
	recurse_copy(__DIR__ . '/src/administrator', $joomlaRoot . '/administrator/components/com_swa');
	echo "Done!\n";
});
$watcher->addListener('site', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying site...\n";
	recurse_copy( __DIR__ . '/src/site', $joomlaRoot . '/components/com_swa');
	echo "Done!\n";
});
$watcher->addListener('administrator', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying swa.xml...\n";
	copy(__DIR__ . '/src/swa.xml', $joomlaRoot . '/administrator/components/com_swa/swa.xml');
	echo "Done!\n";
});

echo "Lurking...\n";
$watcher->start();

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
