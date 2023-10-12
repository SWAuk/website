<?php
namespace SwaUK\Component\Swa\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class Router extends RouterView
{
	protected $noIDs = false;

	/**
	 * The category factory
	 *
	 * @var CategoryFactoryInterface
	 *
	 * @since  4.0.0
	 */
	private $categoryFactory;

	/**
	 * The db
	 *
	 * @var DatabaseInterface
	 *
	 * @since  4.0.0
	 */
	private $db;

	/**
	 * Mywalks Component router constructor
	 *
	 * @param   SiteApplication           $app              The application object
	 * @param   AbstractMenu              $menu             The menu object to work with
	 * @param   CategoryFactoryInterface  $categoryFactory  The category object
	 * @param   DatabaseInterface         $db               The database object
	 */
	public function __construct(SiteApplication $app, AbstractMenu $menu,
		CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{
		$this->categoryFactory = $categoryFactory;
		$this->db              = $db;

		$params = ComponentHelper::getParams('com_swa');
		$this->noIDs = (bool) $params->get('sef_ids');

		$mywalks = new RouterViewConfiguration('swa');
		$mywalks->setKey('id');
		$this->registerView($mywalks);

		$mywalk = new RouterViewConfiguration('swa');
		$mywalk->setKey('id');
		$this->registerView($mywalk);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
	}

	/**
	 * @param   array    A named array
	 *
	 * @return    array
	 */
	function SwaBuildRoute( &$query ) {
		$segments = array();

		if ( isset( $query['task'] ) )
		{
			$segments[] = implode( '/', explode( '.', $query['task'] ) );
			unset( $query['task'] );
		}

		if ( isset( $query['view'] ) )
		{
			$segments[] = $query['view'];
			unset( $query['view'] );
		}

		if ( isset( $query['id'] ) )
		{
			$segments[] = $query['id'];
			unset( $query['id'] );
		}

		return $segments;
	}

	/**
	 * @param   array    A named array
	 * @param   array
	 *
	 * Formats:
	 *
	 * index.php?/swa/task/id/Itemid
	 *
	 * index.php?/swa/id/Itemid
	 */
	function SwaParseRoute( $segments ) {
		$vars = array();

		// View is always the first element of the array
		$vars['view'] = array_shift( $segments );

		while ( ! empty( $segments ) )
		{
			$segment = array_pop( $segments );

			if ( is_numeric( $segment ) )
			{
				$vars['id'] = $segment;
			}
			else
			{
				$vars['task'] = $vars['view'] . '.' . $segment;
			}
		}

		return $vars;
	}
}




