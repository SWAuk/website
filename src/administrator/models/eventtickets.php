<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelEventtickets extends JModelList {

	/**
	 * @param array $config An optional associative array of configuration settings.
	 *
	 * @see        JController
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array(
				'id',
				'event',
				'name',
				'quantity',
				'price',
				'need_level',
				'need_swa',
				'need_xswa',
				'need_host',
				'need_qualification',
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
		parent::populateState( 'event_ticket.id', 'desc' );
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
					array(
						'event_ticket.id',
						'event.name',
						'event_ticket.name',
						'event_ticket.quantity',
						'event_ticket.price',
						'event_ticket.need_level',
						'event_ticket.need_swa',
						'event_ticket.need_xswa',
						'event_ticket.need_host',
						'event_ticket.need_qualification'
					),
					array(
						'id',
						'event',
						'name',
						'quantity',
						'price',
						'need_level',
						'need_swa',
						'need_xswa',
						'need_host',
						'need_qualification')
				)
			)
		);
		$query->from( $db->quoteName( '#__swa_event_ticket', 'event_ticket' ) );
		$query->leftJoin( $db->quoteName( '#__swa_event', 'event' ) . ' ON event.id = event_ticket.event_id' );

		// Filter by search in title
		// clean up the search term
		$searchStr = trim($this->getState( 'filter.search' ));

		// replace the current search term with the cleaned up one
		$this->setState('filter.search', $searchStr);

		if ( !empty( $searchStr ) ) {
			if ( stripos( $searchStr, 'id:' ) === 0 ) {
				$query->where( 'event_ticket.id = ' . (int)substr( $searchStr, 3 ) );
			} else {
				$searchItems = explode(' ', $searchStr);
				foreach ($searchItems as $item) {
					$search = $db->quote('%' . $db->escape($item, true) . '%');
					$search = str_replace('+', '%', $search);

					$where = '( event_ticket.name LIKE ' . $search;
					$where .= ' OR event.name LIKE ' . $search;
					$where .= ' OR event.name LIKE ' . $search . ' )';

					$query->where($where, 'AND');
				}
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
