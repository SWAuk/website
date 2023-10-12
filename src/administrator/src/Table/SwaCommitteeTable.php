<?php
namespace SwaUK\Component\Swa\Administrator\Table;

use Joomla\CMS\Service\Provider\Database;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

class SwaCommitteeTable extends Table
{

	/**
	 * @param   DatabaseDriver $db A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__swa_committee', 'id', $db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array $array Named array
	 *
	 * @return    bool    null is operation was satisfactory, otherwise returns an error
	 * @see        JTable:bind
	 */
	public function bind($array, $ignore = ''): bool {
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new Registry();
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new Registry();
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		return parent::bind($array, $ignore);
	}

	public function delete($pk = null): bool {
		$this->load($pk);
		$result = parent::delete($pk);

		return $result;
	}

}
