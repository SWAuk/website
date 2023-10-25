<?php

namespace SwaUK\Component\Swa\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Router\Route;
use Joomla\CMS\User\CurrentUserInterface;
use SwaUK\Component\Swa\Administrator\Controller\SwaAdminController;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.controlleradmin' );

class CommitteeMembersController extends SwaAdminController {

	protected $default_view = 'committeemembers';
	protected string $model_view = "CommitteeMembers";
	protected $model_prefix = "Administrator";

}
