<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Methods supporting a list of Swa records.
 */
class SwaModelUniversityMembers extends JModelList {

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
				'committee',
				'a.committee',
				'graduated',
				'a.graduated',
			);
		}

		parent::__construct( $config );
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState( $ordering = null, $direction = null ) {
		// Initialise variables.
		$app = JFactory::getApplication( 'administrator' );

		// Load the filter state.
		$search =
			$app->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' );
		$this->setState( 'filter.search', $search );

		// Load the parameters.
		$params = JComponentHelper::getParams( 'com_swa' );
		$this->setState( 'params', $params );

		// List state information.
		parent::populateState( 'a.id', 'asc' );
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
			array(
				'a.id as id',
				'a.graduated as graduated',
				'IF(a.committee="NULL", "None", a.committee) as committee',
			)
		);
		$query->from( '`#__swa_university_member` AS a' );

		$query->join(
			'LEFT',
			'`#__swa_university` AS university ON a.university_id=university.id'
		);
		$query->select( 'university.name as university' );

		$query->join( 'LEFT', '`#__swa_member` AS member ON a.member_id=member.id' );
		$query->join( 'LEFT', '`#__users` AS user ON member.user_id=user.id' );
		$query->select( 'user.name as member' );

		// Filter by search in title
		$search = $this->getState( 'filter.search' );
		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( 'a.id = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
				$query->where(
					'( user.name LIKE ' . $search . ' OR  user.username LIKE ' . $search . ' )'
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
