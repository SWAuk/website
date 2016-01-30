<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Methods supporting a list of Swa records.
 */
class SwaModelGrants extends JModelList {

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
				'created_by',
				'a.created_by',
				'event_id',
				'a.event_id',
				'application_date',
				'a.application_date',
				'amount',
				'a.amount',
				'fund_use',
				'a.fund_use',
				'instructions',
				'a.instructions',
				'ac_sortcode',
				'a.ac_sortcode',
				'ac_number',
				'a.ac_number',
				'ac_name',
				'a.ac_name',
				'finances_date',
				'a.finances_date',
				'finances_id',
				'a.finances_id',
				'auth_date',
				'a.auth_date',
				'auth_id',
				'a.auth_id',
				'payment_date',
				'a.payment_date',
				'payment_id',
				'a.payment_id',

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
		$query->from( '`#__swa_grant` AS a' );

		// Join over the user field 'created_by'
		$query->select( 'created_by.name AS created_by' );
		$query->join( 'LEFT', '#__users AS created_by ON created_by.id = a.created_by' );
		// Join over for event_id
		$query->select( 'event_id.name AS event' );
		$query->join( 'LEFT', '#__swa_event AS event_id ON event_id.id = a.event_id' );

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
