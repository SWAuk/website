<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Router\Route;
use Joomla\CMS\User\CurrentUserInterface;
use SwaUK\Component\Swa\Administrator\Controller\SwaAdminController;

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SwaCommitteeMembersController extends SwaAdminController
{/**
 * The default view.
 *
 * @var    string
 * @since  1.6
 */
	protected $default_view = 'swa_committeemembers';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
	 *
	 * @return  static  This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$view   = $this->input->get('view', $this->default_view);
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'swacommitteemembers' && $layout == 'edit' && !$this->checkEditId('com_mywalks.edit.mywalk_date', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
			$this->setRedirect(Route::_('index.php?option=com_swa&view=swacommitteemembers', false));

			return false;
		}

		return parent::display();
	}

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  BaseDatabaseModel
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'SwaCommitteeMembers', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}
