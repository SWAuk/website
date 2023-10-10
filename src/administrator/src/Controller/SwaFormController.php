<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\FormController;

class SwaFormController extends FormController
{
	public function save($key = null, $urlVar = null): bool {
		$saveResult = parent::save($key, $urlVar);

		Log::add(
			implode(
				', ',
				array(
					Factory::getApplication()->getIdentity()->name,
					get_called_class() . '::' . __FUNCTION__,
					json_encode($this->input->post->get('jform', array(), 'array')),
				)
			),
			Log::INFO,
			'com_swa.audit_backend'
		);

		return $saveResult;
	}

}
