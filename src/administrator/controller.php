<?php
defined('_JEXEC') or die;

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
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT . '/helpers/swa.php';

		$view = JFactory::getApplication()->input->getCmd('view', 'home');
		JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}

}
