<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;

class SwaControllerForm extends JControllerForm
{

	public function save($key = null, $urlVar = null)
	{
		$saveResult = parent::save($key, $urlVar);

		Log::add(
			implode(
				', ',
				[
					Factory::getApplication()->getIdentity()->name,
					get_called_class() . '::' . __FUNCTION__,
					json_encode($this->input->post->get('jform', [], 'array')),
				]
			),
			Log::INFO,
			'com_swa.audit_backend'
		);

		return $saveResult;
	}

}
