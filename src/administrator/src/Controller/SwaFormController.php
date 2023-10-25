<?php

namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;

class SwaFormController extends FormController {
	protected string $view_name = 'home';

	public function save( $key = null, $urlVar = null ): bool {
		$saveResult = parent::save( $key, $urlVar );

		Log::add(
			implode(
				', ',
				array(
					Factory::getApplication()->getIdentity()->name,
					get_called_class() . '::' . __FUNCTION__,
					json_encode( $this->input->post->get( 'jform', array(), 'array' ) ),
				)
			),
			Log::INFO,
			'com_swa.audit_backend'
		);

		return $saveResult;
	}

	public function display( $cachable = false, $urlparams = array() ) {
		$view   = $this->input->get( 'view', $this->default_view );
		$layout = $this->input->get( 'layout', 'default' );
		$id     = $this->input->getInt( 'id' );

		// Check for edit form.
		if ( $view == $this->view_name && $layout == 'edit' && ! $this->checkEditId( 'com_swa.edit.' . $this->view_name, $id ) )
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setMessage( Text::sprintf( 'JLIB_APPLICATION_ERROR_UNHELD_ID', $id ), 'error' );
			$this->setRedirect( Route::_( 'index.php?option=com_swa&view=' . $this->view_name, false ) );

			return $this;
		}

		return parent::display();
	}

}
