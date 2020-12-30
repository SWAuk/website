<?php

trait SwaModelMemberTrait
{
	/**
	 * @var JTable
	 */
	protected $member;

	/**
	 * NOTE: If this is updated also check the viewlevels plugin works
	 * @return JTable|mixed
	 */
	public function getMember()
	{
		if (!isset($this->member))
		{
			// Create a new query object.
			$db    = $this->getDbo();
			$query = $db->getQuery(true);
			$user  = JFactory::getUser();

			// Select the required fields from the table.
			$query->select( 'member.*' );
			$query->select( '!ISNULL(committee.id) AS swa_committee' );
			$query->select( 'membership.committee AS club_committee' );
			$query->select( 'uni.id AS uni_id' );
			$query->select( 'uni.name AS university_name' );
			$query->select( 'season.id AS season_id' );
			$query->select('season.year AS season_year');

			$query->from( '#__swa_member AS member' );
			$query->leftJoin( '#__swa_committee AS committee ON committee.member_id = member.id');
			$query->leftJoin( '#__swa_membership AS membership on membership.member_id = member.id' );
			$query->leftJoin( '#__swa_university AS uni ON uni.id = membership.uni_id' );
			$query->leftJoin( '#__swa_season AS season ON season.id = membership.season_id' );

			$query->order('season.year DESC');

			// Load the result
			$db->setQuery($query);
			$this->member = $db->loadObject();

			$now       = time();
			$seasonEnd = strtotime("1st June");
			$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

			if ($this->member !== null)
			{
				$season_member = substr($this->member->season_year, 0, 4) === $date;
				$this->member->paid = $season_member || $this->member->lifetime_member;
			}
		}

		return $this->member;
	}

}
