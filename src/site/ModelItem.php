<?php

abstract class SwaModelItem extends JModelItem
{

    /**
     * @var JTable
     */
    protected $member;

    /**
     * @return JTable|mixed
     */
    public function getMember()
    {
        if (!isset($this->member)) {
            // Create a new query object.
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            $user = JFactory::getUser();

            // Select the required fields from the table.
            $query->select('a.*');
            $query->from('#__swa_member AS a');
            $query->where('a.user_id = ' . (int)$user->id);

            // Join on committee table
            $query->leftJoin('#__swa_committee AS committee ON committee.member_id = a.id');
            $query->select('!ISNULL(committee.id) AS swa_committee');

            // Join on university_member table
            $query->leftJoin('#__swa_university_member AS uni_member ON uni_member.member_id = a.id');
            $query->select('uni_member.committee AS club_committee');

            $now = time();
            $seasonEnd = strtotime("1st June");
            $date = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);
            // Join on membership table
            $query->leftJoin('#__swa_membership AS membership ON membership.member_id = a.id');
            $query->select('membership.season_id');
            $query->leftJoin('#__swa_season AS season ON membership.season_id = season.id');
            $query->where('(season.year LIKE "' . (int)$date . '%" OR membership.season_id IS NULL)');

            // Load the result
            $db->setQuery($query);
            $this->member = $db->loadObject();

            //
            if ($this->member !== null) {
                $this->member->paid = $this->member->season_id != null || $this->member->lifetime_member;
            }
        }

        return $this->member;
    }

}