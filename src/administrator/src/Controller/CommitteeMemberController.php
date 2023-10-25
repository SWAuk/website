<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class CommitteeMemberController extends SwaFormController
{
	public function display($cachable = false, $urlparams = array())
	{
		$view   = $this->input->get('view', $this->default_view);
		$layout = $this->input->get('layout', 'edit');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'swacommitteemember' && $layout == 'edit' && !$this->checkEditId('com_swa.edit.committeemember', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
			$this->setRedirect(Route::_('index.php?option=com_swa&view=swacommitteemembers', false));

			return false;
		}

		return parent::display();
	}
}
