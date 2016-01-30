<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Methods supporting a list of Swa records.
 */
class SwaModelEvents extends JModelList {

	/**
	 * Constructor.
	 *
	 * @param    array    An optional associative array of configuration settings.
	 *
	 * @see        JController
	 * @since    1.6
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array(
				'id',
				'a.id',
				'name',
				'a.name',
				'season_id',
				'a.season_id',
				'capacity',
				'a.capacity',
				'date_open',
				'a.date_open',
				'date_close',
				'a.date_close',
				'date',
				'a.date',

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
		parent::populateState( 'a.id', 'desc' );
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
	 * @since    1.6
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
	 * @since    1.6
	 */
	protected function getListQuery() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery( true );

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'DISTINCT a.*'
			)
		);
		$query->from( '`#__swa_event` AS a' );
		$query->group( 'a.id' );

		// Join over for season_id
		$query->select( 'season_id.year AS season' );
		$query->join( 'LEFT', '#__swa_season AS season_id ON season_id.id = a.season_id' );

		// Join for hosts
		$query->select( 'GROUP_CONCAT(university.name) AS hosts' );
		$query->join( 'LEFT', '#__swa_event_host AS event_host ON a.id = event_host.id' );
		$query->join(
			'LEFT',
			'#__swa_university AS university ON event_host.university_id = university.id'
		);

		// Filter by search in title
		$search = $this->getState( 'filter.search' );
		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( 'a.id = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
				$query->where( '( a.name LIKE ' . $search . ' )' );
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
