<?php

abstract class SwaModelItem extends JModelItem {

	/**
	 * @var JTable
	 */
	protected $member;

	/**
	 * @return JTable|mixed
	 */
	public function getMember() {
		if ( !isset( $this->member ) ) {
			// Create a new query object.
			$db = $this->getDbo();
			$query = $db->getQuery( true );
			$user = JFactory::getUser();

			// Select the required fields from the table.
			$query->select( 'a.*' );
			$query->from( $db->quoteName( '#__swa_member' ) . ' AS a' );
			$query->where( 'a.user_id = ' . $user->id );

			// Join on committee table
			$query->leftJoin( '#__swa_committee as committee on committee.member_id = a.id' );
			$query->select( '!ISNULL(committee.id) as swa_committee' );

			// Join on committee table
			$query->leftJoin(
				'#__swa_university_member as uni_member on uni_member.member_id = a.id'
			);
			$query->select( 'uni_member.committee as club_committee' );
			$query->select( 'uni_member.university_id as uni_id' );

			// Load the result
			$db->setQuery( $query );
			$this->member = $db->loadObject();
		}

		return $this->member;
	}

}