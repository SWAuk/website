<?php
namespace SwaUK\Component\Swa\Administrator\Model;
defined('_JEXEC') or die;
jimport('joomla.application.component.modeladmin');

class CommitteeMemberModel extends SwaAdminModel
{
	protected string $form_name = 'member';
	protected string $table_name = '#__swa_member';

}
