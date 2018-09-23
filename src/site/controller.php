<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class SwaController extends JControllerLegacy
{

	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   array   $urlparams An array of safe url parameters and their variable types, for
	 *                             valid values see {@link JFilterInput::clean()}.
	 *
	 * @return    JController        This object to support chaining.
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT . '/helpers/swa.php';

		$view = JFactory::getApplication()->input->getCmd('view', 'home');
		JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}

	/**
	 * Logs the given message to the frontend audit log.
	 * Automatically adds the current users name
	 *
	 * @param   string $message
	 */
	protected function logAuditFrontend($message)
	{
		$user = JFactory::getUser();
		JLog::add(
			$user->name . ' ' . $message,
			JLog::INFO,
			'com_swa.audit_frontend'
		);
	}

}
