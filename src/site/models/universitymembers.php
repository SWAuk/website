<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modeladmin' );

class SwaModelUniversityMembers extends SwaModelList {

    protected $items;

    public function getTable( $type = 'Member', $prefix = 'SwaTable', $config = array() ) {
        return JTable::getInstance( $type, $prefix, $config );
    }

    public function getListQuery() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );

        $query->select( 'member.*' );
        $query->from( $db->qn( '#__swa_member', 'member' ) );
        $query->where( 'member.university_id = ' . (int)$this->getMember()->university_id );

        // Join onto joomla user table
        $query->select( 'user.name AS name' );
        $query->join( 'LEFT', '#__users AS user ON member.user_id = user.id' );

        // Join onto the university_member table
        $query->leftJoin(
            $db->qn( '#__swa_university_member', 'uni_member' ) .
            ' ON member.id = uni_member.member_id'
        );
        $query->select( 'COALESCE( uni_member.graduated, 0 ) AS graduated' );
        $query->select( '!ISNULL( uni_member.member_id ) AS confirmed_university' );
        $query->select( 'uni_member.committee AS club_committee' );


        $now = time();
        $seasonEnd = strtotime( "1st June" );
        $date = $now < $seasonEnd ? date( "Y", strtotime( '-1 year', $now ) ) : date( "Y", $now );
        // Join on membership table
        $query->select( 'membership.season_id' );
        $query->leftJoin( '#__swa_membership AS membership ON membership.member_id = member.id' );
        $query->leftJoin( '#__swa_season AS season ON membership.season_id = season.id' );
        $query->where( '(season.year LIKE "' . (int)$date . '%" OR membership.season_id IS NULL)' );

        return $query;
    }

    public function getItems() {
        //NEVER limit this list
        $this->setState( 'list.limit', '0' );

        if ( !isset( $this->items ) ) {
            $this->items = parent::getItems();
        }

        return $this->items;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState( $ordering = null, $direction = null ) {
        // List state information.
        parent::populateState( 'name', 'desc' );
    }

    /**
     * Gets a list of event items that have not yet closed
     * @return array
     */
    public function getAvailableEvents() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );

        $query->select( 'event.*' );
        $query->from( $db->quoteName( '#__swa_event' ) . ' AS event' );
        $query->where( 'event.date_close >= CURDATE()' );

        $db->setQuery( $query );
        $result = $db->execute();

        if ( !$result ) {
            JLog::add(
                'SwaModelUniversityMembers::getAvailableEvents failed to do db query',
                JLog::ERROR,
                'com_swa'
            );

            return array();
        }

        return $db->loadObjectList();
    }

    /**
     * Gets a list of event registrations for the members listed
     * @return array
     */
    public function getEventRegistrations() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );

        $query->from( $db->quoteName( '#__swa_event_registration' ) . ' AS event_registration' );
        $query->select( 'event_registration.*' );
        foreach ( $this->getItems() as $member ) {
            $query->where( 'event_registration.member_id = ' . $member->id, 'OR' );
        }

        $db->setQuery( $query );
        $result = $db->execute();

        if ( !$result ) {
            JLog::add(
                'SwaModelUniversityMembers::getEventRegistrations failed to do db query',
                JLog::ERROR,
                'com_swa'
            );

            return array();
        }

        return $db->loadObjectList( 'id' );
    }

}