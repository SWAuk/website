<?php
/**
 * @package     SwaUK\Component\Swa\Administrator\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace SwaUK\Component\Swa\Administrator\Controller;
defined( '_JEXEC' ) or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\LegacyFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class DisplayController extends BaseController {
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 */
	protected $default_view = 'home';

	public function display( $cachable = false, $urlparams = array() ) {
		Log::addLogger( array(
			'text_file' => "com_swa.log.all"
		) );
		$document   = Factory::getDocument();
		$viewName   = $this->input->get( 'view', $this->default_view );
		$layoutName = $this->input->get( 'layout', $this->default_view );
		$viewFormat = $document->getType();
		$view       = $this->getView( $viewName, $viewFormat );
		$view->setLayout( $layoutName );

		$model = $this->getModel( $viewName );
		if ( $model )
		{
			$view->setModel( $model, true );
		}
		$view->document = $document;
		$this->input->set( "view", $view );
		$view->display();
	}
}
