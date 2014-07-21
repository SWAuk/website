<?php
/**
 * Script to easily zip all components up
 */

//TODO auto get all dirs
$components = array(
	'com_swa'
);

echo "Ziping all...\n";

foreach( $components as $dir ) {
	unlink(  __DIR__ . DIRECTORY_SEPARATOR . $dir . '.zip');
	zipRecurive( __DIR__ . DIRECTORY_SEPARATOR . $dir , __DIR__ . DIRECTORY_SEPARATOR . $dir . '.zip', __DIR__ );
	echo "Done " . __DIR__ . DIRECTORY_SEPARATOR . $dir . '.zip' . "\n";
}

echo "All Done\n";

function zipRecurive($source, $destination) {
	$source = realpath($source);

	if (!extension_loaded('zip') || !file_exists($source)) { return false; }

	$zip = new ZipArchive();
	if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
		return false;
	}

	if (is_dir($source) === true){
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

		foreach ($files as $file){
			$file = str_replace('\\', '/', $file);

			// Ignore "." and ".." folders
			if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
				continue;

			$file = realpath($file);
			if (is_dir($file) === true){
				$name = rtrim( str_replace($source . DIRECTORY_SEPARATOR, '', $file . DIRECTORY_SEPARATOR) , '\\');
				$zip->addEmptyDir($name);
			}else if (is_file($file) === true){
				$name = str_replace($source . DIRECTORY_SEPARATOR, '', $file);
				$zip->addFromString($name, file_get_contents($file));
			}
		}
	}else if (is_file($source) === true){
		$zip->addFromString(basename($source), file_get_contents($source));
	}
	return $zip->close();
}