<?php
namespace Joomla\CMS\swa\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class SwaController extends BaseController
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   array   $urlparams An array of safe URL parameters and their variable types.
	 *
	 * @return  BaseController  This object to support chaining.
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT . '/helpers/swa.php';

		$view = Factory::getApplication()->input->getCmd('view', 'home');
		Factory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}

	/**
	 * Logs the given message to the frontend audit log.
	 * Automatically adds the current user's name.
	 *
	 * @param   string $message
	 */
	protected function logAuditFrontend($message)
	{
		$user = Factory::getUser();
		JLog::add(
			$user->name . ' ' . $message,
			JLog::INFO,
			'com_swa.audit_frontend'
		);
	}
}
