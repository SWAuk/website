<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\FormController;

class SwaControllerForm extends FormController {

	public function save( $key = null, $urlVar = null ) {
		Log::add( "ATtempting to save form?" );
		$saveResult = parent::save( $key, $urlVar );

		try
		{
			$jsonEncode = json_encode( $this->input->post->get( 'jform', [], 'array' ) );
		}
		catch ( Exception $e )
		{
			$jsonEncode = "{}";
			Log::add( "Failed to parse form json\n" . $e->getMessage(), Log::INFO,
				'com_swa.audit_backend' );
		}

		Log::add(
			implode(
				', ',
				[
					Factory::getApplication()->getIdentity()->name,
					get_called_class() . '::' . __FUNCTION__,
					$jsonEncode,
				]
			),
			Log::INFO,
			'com_swa.audit_backend'
		);

		return $saveResult;
	}

}
