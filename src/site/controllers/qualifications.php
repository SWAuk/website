<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerQualifications extends SwaController {

	public function add() {
		$file = JFactory::getApplication()->input->files->get('jform');
		$filePath = $file['tmp_name'];
		if( !file_exists( $filePath ) ) {
			die( 'Couldn\'t find uploaded file!' );
		}

		//TODO implement me
		die('not yet implemented');
	}

}