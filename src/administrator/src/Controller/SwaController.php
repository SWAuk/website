<?php
namespace SwaUK\Component\Swa\Administrator\Controller;

defined('_JEXEC') or die;
use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;

class SwaController extends BaseController
{

	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   array   $urlparams An array of safe url parameters and their variable types, for
	 *                             valid values see {@link JFilterInput::clean()}.
	 *
	 * @return    BaseController        This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false): BaseController {
		try
		{
			$view = Factory::getApplication()->input->getCmd( 'view', 'home' );
			Factory::getApplication()->input->set('view', $view);
			parent::display($cachable, $urlparams);
		}
		catch ( Exception )
		{
			Log::add('Failed to Get application in swa.php', Log::ERROR);
		}
		return $this;
	}
}
