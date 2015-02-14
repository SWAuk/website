<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * member Table class
 */
class SwaTablemember extends JTable {

	/**
	 * Constructor
	 *
	 * @param JDatabase A database connector object
	 */
	public function __construct( &$db ) {
		parent::__construct( '#__swa_member', 'id', $db );
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param    array        Named array
	 *
	 * @return    null|string    null is operation was satisfactory, otherwise returns an error
	 * @see        JTable:bind
	 * @since    1.5
	 */
	public function bind( $array, $ignore = '' ) {
		//Support for checkbox field: paid
		if ( !isset( $array['paid'] ) ) {
			$array['paid'] = 0;
		}

		if ( isset( $array['params'] ) && is_array( $array['params'] ) ) {
			$registry = new JRegistry();
			$registry->loadArray( $array['params'] );
			$array['params'] = (string)$registry;
		}

		if ( isset( $array['metadata'] ) && is_array( $array['metadata'] ) ) {
			$registry = new JRegistry();
			$registry->loadArray( $array['metadata'] );
			$array['metadata'] = (string)$registry;
		}

		return parent::bind( $array, $ignore );
	}

	public function delete( $pk = null ) {
		$this->load( $pk );
		$result = parent::delete( $pk );
		if ( $result ) {

		}
		return $result;
	}

}
