<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_swa
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Membership controller class.
 */
class SwaControllerMembership extends SwaControllerForm
{

	public function __construct()
	{
		$this->view_list = 'memberships';
		parent::__construct();
	}

}
