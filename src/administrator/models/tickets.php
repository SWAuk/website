<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelTickets extends JModelList {

    /**
     * @param array $config An optional associative array of configuration settings.
     *
     * @see        JController
     */
    public function __construct( $config = array() ) {
        if ( empty( $config['filter_fields'] ) ) {
            $config['filter_fields'] = array(
                'id',
                'name',
                'event',
                'ticket_type',
                'paid',
            );
        }

        parent::__construct( $config );
    }

    protected function populateState( $ordering = null, $direction = null ) {
        $app = JFactory::getApplication( 'administrator' );
        $this->setState(
            'filter.search',
            $app->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' )
        );
        $this->setState( 'params', JComponentHelper::getParams( 'com_swa' ) );
        parent::populateState( 'ticket.id', 'desc' );
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param    string $id A prefix for the store id.
     *
     * @return    string        A store id.
     */
    protected function getStoreId( $id = '' ) {
        // Compile the store id.
        $id .= ':' . $this->getState( 'filter.search' );

        return parent::getStoreId( $id );
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return    JDatabaseQuery
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery( true );

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                $db->quoteName(
                    array( 'user.name', 'event.name', 'event_ticket.name', 'ticket.paid', 'ticket.id' ),
                    array( 'name', 'event', 'ticket_type', 'paid', 'id' )
                )
            )
        );
        $query->from( $db->quoteName( '#__swa_ticket', 'ticket' ) );
        $query->leftJoin( $db->qn( '#__swa_member', 'member' ) .
            ' ON ticket.member_id = member.id' );
        $query->leftJoin( $db->qn( '#__users', 'user' ) . ' ON member.user_id = user.id' );
        $query->leftJoin(
            $db->qn( '#__swa_event_ticket', 'event_ticket' ) . ' ON ticket.event_ticket_id = event_ticket.id'
        );
        $query->leftJoin($db->qn( '#__swa_event', 'event' ) . ' ON event_ticket.event_id = event.id' );

        // Filter by search in title
        $search = $this->getState( 'filter.search' );
        if ( !empty( $search ) ) {
            if ( stripos( $search, 'id:' ) === 0 ) {
                $query->where( 'ticket.id = ' . (int)substr( $search, 3 ) );
            } else {
                $search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
                $query->where(
                    '( user.name LIKE ' . $search .
                    ' OR  user.username LIKE ' . $search .
                    ' OR  event.name LIKE ' . $search .
                    ' )'
                );
            }
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get( 'list.ordering' );
        $orderDirn = $this->state->get( 'list.direction' );
        if ( $orderCol && $orderDirn ) {
            $query->order( $db->escape( $orderCol . ' ' . $orderDirn ) );
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();

        return $items;
    }

}
