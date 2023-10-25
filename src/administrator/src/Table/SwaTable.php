<?php

namespace SwaUK\Component\Swa\Administrator\Table;

use Joomla\CMS\Log\Log;
use Joomla\CMS\Table\Table;

/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class SwaTable extends Table {

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
			Log::add( "Failed in check method of table", Log::INFO, "com_swa.audit_backend" );

			return true;
		}

		return true;
	}

}
