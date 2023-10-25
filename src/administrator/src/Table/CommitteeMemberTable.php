<?php

namespace SwaUK\Component\Swa\Administrator\Table;

use Joomla\CMS\Log\Log;
use Joomla\CMS\Service\Provider\Database;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;

defined( '_JEXEC' ) or die;

class CommitteeMemberTable extends Table {

	/**
	 * @param   DatabaseDriver  $db  A database connector object
	 */
	public function __construct( &$db ) {
		parent::__construct( '#__swa_committee', 'id', $db );
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  $array  Named array
	 *
	 * @return    bool    null is operation was satisfactory, otherwise returns an error
	 * @see        JTable:bind
	 */
	public function bind( $array, $ignore = '' ): bool {
		if ( isset( $array['params'] ) && is_array( $array['params'] ) )
		{
			$registry        = new Registry($array['params']);
			$array['params'] = (string) $registry;
		}

		if ( isset( $array['metadata'] ) && is_array( $array['metadata'] ) )
		{
			$registry          = new Registry( $array['metadata'] );
			$array['metadata'] = (string) $registry;
		}

		return parent::bind( $array, $ignore );
	}

	public function delete( $pk = null ): bool {
		$this->load( $pk );
		$result = parent::delete( $pk );

		return $result;
	}

	/**
	 * Overloaded check function, can add form verification
	 *
	 * @return  boolean  True on success, false on failure
	 *
	 * @see     Table::check()
	 * @since   1.5
	 */
	public function check() {
		try
		{
			parent::check();
		}
		catch ( \Exception $e )
		{
//			$this->setError( $e->getMessage() );
			Log::add("Failed in check method of table", Log::INFO, "com_swa.audit_backend");
			return true;
		}
		return true;
	}

}
