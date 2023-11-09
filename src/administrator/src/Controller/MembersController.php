<?php
namespace SwaUK\Component\Swa\Administrator\Controller;
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.controlleradmin' );

/**
 * Member list controller class.
 */
class MembersController extends SwaAdminController {
	protected $default_view = 'members';
	protected string $model_view = "Members";
	protected $model_prefix = "Administrator";
}
