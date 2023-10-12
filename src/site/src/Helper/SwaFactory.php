<?php

namespace SwaUK\Component\Swa\Site\Helper;

use Joomla\CMS\Factory;

class SwaFactory {
	public static function getUserFromMemberId( $id ) {
		// Create a new query object.
		$db    = Factory::getDbo();
		$query = $db->getQuery( true );

		// Select the required fields from the table.
		$query->select( 'a.*' );
		$query->from( $db->quoteName( '#__swa_member' ) . ' AS a' );
		$query->where( 'a.id = ' . $id );

		// Load the result
		$db->setQuery( $query );
		$member = $db->loadObject();

		if ( ! $member->user_id )
		{
			throw new RuntimeException;
		}

		return Factory::getUser( $member->user_id );
	}

}
