<?php

defined( '_JEXEC' ) or die;

class SwaTableseason extends JTable {

	/**
	 * @param JDatabase $db A database connector object
	 */
	public function __construct( &$db ) {
		parent::__construct( '#__swa_season', 'id', $db );
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param array $array Named array
	 *
	 * @return    null|string    null is operation was satisfactory, otherwise returns an error
	 * @see        JTable:bind
	 */
	public function bind( $array, $ignore = '' ) {
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

		return $result;
	}

}
