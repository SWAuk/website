<?php
namespace SwaUK\Component\Swa\Administrator\Table;

use Joomla\CMS\Service\Provider\Database;
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class SwaEventTable extends Table
{

	/**
	 * @param   Database $db A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__swa_event', 'id', $db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array $array Named array
	 *
	 * @return    bool    null is operation was satisfactory, otherwise returns an error
	 * @see        Table:bind
	 */
	public function bind($array, $ignore = ''): bool {
		if ( isset($array['params']) )
		{
			if ( is_array( $array['params'] ) )
			{
				$registry = new Joomla\Registry\Registry();
				$registry->loadArray( $array['params'] );
				$array['params'] = (string) $registry;
			}
		}

		if ( isset($array['metadata']) )
		{
			if ( is_array( $array['metadata'] ) )
			{
				$registry = new Joomla\Registry\Registry();
				$registry->loadArray( $array['metadata'] );
				$array['metadata'] = (string) $registry;
			}
		}

		return parent::bind($array, $ignore);
	}

	public function delete($pk = null): bool {
		$this->load($pk);
		return parent::delete($pk);
	}

}
