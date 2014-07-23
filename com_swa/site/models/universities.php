<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Methods supporting a list of Swa records.
 */
class SwaModelUniversities extends JModelList {

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
				'id', 'a.id',
				'ordering', 'a.ordering',
				'state', 'a.state',
				'created_by', 'a.created_by',
				'name', 'a.name',
				'code', 'a.code',
				'url', 'a.url',
				'password', 'a.password',

			);
		}
		parent::__construct( $config );
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since    1.6
	 */
	protected function populateState( $ordering = null, $direction = null ) {

		// Initialise variables.
		$app = JFactory::getApplication();

		// List state information
		$limit = $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg( 'list_limit' ) );
		$this->setState( 'list.limit', $limit );

		$limitstart = JFactory::getApplication()->input->getInt( 'limitstart', 0 );
		$this->setState( 'list.start', $limitstart );

		if ( empty( $ordering ) ) {
			$ordering = 'a.ordering';
		}

		// List state information.
		parent::populateState( $ordering, $direction );
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
				'list.select', 'DISTINCT a.*'
			)
		);

		$query->from( '`#__swa_university` AS a' );

		// Join over the users for the checked out user.
		$query->select( 'uc.name AS editor' );
		$query->join( 'LEFT', '#__users AS uc ON uc.id=a.checked_out' );

		// Join over the created by field 'created_by'
		$query->join( 'LEFT', '#__users AS created_by ON created_by.id = a.created_by' );

		// Filter by search in title
		$search = $this->getState( 'filter.search' );
		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( 'a.id = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
				$query->where( '( a.name LIKE ' . $search . '  OR  a.code LIKE ' . $search . '  OR  a.url LIKE ' . $search . '  OR  a.password LIKE ' . $search . ' )' );
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
