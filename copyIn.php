<?php

/**
 * Joomla Install -> GIT
 *
 * This file allows you to copy changes from a deployed version of the component
 * back to the git repo!
 * This means that you can develop on your live test code!
 */

require_once __DIR__ . '/vendor/autoload.php';

use Lurker\Event\FilesystemEvent;
use Lurker\ResourceWatcher;

$joomlaRoot = __DIR__ . '/.docker/www';

$watcher = new ResourceWatcher;
$watcher->track('administrator', $joomlaRoot . '/administrator/components/com_swa');
$watcher->track('site', $joomlaRoot . '/components/com_swa');
$watcher->track('swa.xml', $joomlaRoot . '/src/administrator/swa.xml');

$watcher->addListener('administrator', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying administrator...\n";
	recurseCopy($joomlaRoot . '/administrator/components/com_swa', __DIR__ . '/src/administrator');
	echo "Done!\n";
});
$watcher->addListener('site', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying site...\n";
	recurseCopy($joomlaRoot . '/components/com_swa', __DIR__ . '/src/site');
	echo "Done!\n";
});
$watcher->addListener('swa.xml', function (FilesystemEvent $event) use ( $joomlaRoot ) {
	echo "Copying swa.xml...\n";
	rename($joomlaRoot . '/src/administrator/swa.xml', __DIR__ . '/src/swa.xml');
	echo "Done!\n";
});

echo "Lurking...\n";
$watcher->start();

/**
 * Taken from the doc page of copy
 * http://php.net/manual/en/function.copy.php#91010
 */
function recurseCopy($src, $dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	while (false !== ( $file = readdir($dir))) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if (is_dir($src . '/' . $file)) {
				recurseCopy($src . '/' . $file, $dst . '/' . $file);
			}
else {
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
