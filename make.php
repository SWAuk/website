<?php

$rootDir = __DIR__ . DIRECTORY_SEPARATOR;

// Generate the zip
echo "Zipping all...\n";
@unlink( $rootDir . 'com_swa.zip' );
$out=zipRecursive( $rootDir . 'src', $rootDir . 'com_swa.zip' );

if ($out) {
	echo "Done " . $rootDir . 'com_swa.zip' . "\n";
} else {
	echo "Error creating ZIP.";
}

/**
 * @param string $source
 * @param string $destination
 *
 * @return bool
 */
function zipRecursive( $source, $destination ) {
	$source = realpath( $source );

	if ( !extension_loaded( 'zip' ) ) {
		echo "ERROR - extention 'zip' not loaded.\n";
		return false;
	}

	if ( !file_exists( $source ) ) {
		echo "ERROR - source '" . $source . "' doesn't exist.\n";
		return false;
	}

	$zip = new ZipArchive();
	if ( !$zip->open( $destination, ZIPARCHIVE::CREATE ) ) {
		return false;
	}

	if ( is_dir( $source ) === true ) {
		$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $source ), RecursiveIteratorIterator::SELF_FIRST );

		foreach ( $files as $file ) {
			$file = str_replace( '\\', '/', $file );

			// Ignore "." and ".." folders
			if ( in_array( substr( $file, strrpos( $file, '/' ) + 1 ), array( '.', '..' ) ) ) {
				continue;
			}

			$file = realpath( $file );
			if ( is_dir( $file ) === true ) {
				$name = rtrim( str_replace( $source . DIRECTORY_SEPARATOR, '', $file . DIRECTORY_SEPARATOR ), '\\' );
				$zip->addEmptyDir( $name );
			} else if ( is_file( $file ) === true ) {
				$name = str_replace( $source . DIRECTORY_SEPARATOR, '', $file );
				$zip->addFromString( $name, file_get_contents( $file ) );
			}
		}
	} else if ( is_file( $source ) === true ) {
		$zip->addFromString( basename( $source ), file_get_contents( $source ) );
	}
	return $zip->close();
}
