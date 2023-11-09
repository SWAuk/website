<?php
namespace SwaUK\Component\Swa\Administrator\Table;

use Joomla\Registry\Registry;

defined( '_JEXEC' ) or die;

class MemberTable extends SwaTable {
	public function __construct( &$db ) {
		parent::__construct( '#__swa_member', 'id', $db );
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  $array  Named array
	 *
	 * @return    bool    null is operation was satisfactory, otherwise returns an error
	 * @see        \Joomla\CMS\Table\Table:bind
	 */
	public function bind( $array, $ignore = '' ) {
		// Support for checkbox field: paid
		if ( ! isset( $array['paid'] ) )
		{
			$array['paid'] = 0;
		}
		if ( isset( $array['params'] ) && is_array( $array['params'] ) )
		{
			$registry        = new Registry( $array['params'] );
			$array['params'] = (string) $registry;
		}

		if ( isset( $array['metadata'] ) && is_array( $array['metadata'] ) )
		{
			$registry          = new Registry( $array['metadata'] );
			$array['metadata'] = (string) $registry;
		}

		return parent::bind( $array, $ignore );
	}

}
