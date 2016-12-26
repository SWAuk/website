<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelEventregistrations extends JModelList {

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
				'member',
				'university',
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
		parent::populateState( 'event_registration.id', 'desc' );
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
		$query->select( 'event_registration.id AS id' );
		$query->select( 'user.name AS member' );
		$query->select( 'event.name AS event' );
		$query->select( 'uni.name AS university' );

		$query->from( '`#__swa_event_registration` AS event_registration' );

		$query->leftJoin( '#__swa_member AS member ON member.id = event_registration.member_id' );
		$query->leftJoin( '#__users AS user ON user.id = member.user_id' );
		$query->leftJoin( '#__swa_event AS event ON event.id = event_registration.event_id' );
		$query->leftJoin( '#__swa_university_member AS uni_member ON uni_member.member_id = member.id' );
		$query->leftJoin( '#__swa_university AS uni ON uni.id = uni_member.university_id' );

		// Filter by search in title
		// clean up the search term
		$search = trim($this->getState( 'filter.search' ));
		// replace 2 or more consecutive whitespaces with a single space
		$search = preg_replace('/\s{2,}/', ' ', $search);

		// replace the current search term with the cleaned up one
		$this->setState('filter.search', $search);

		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( 'event_registration.id = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
				$search = str_replace(' ', '%', $search);

				$query->where(
					'( event.name LIKE ' . $search .
					' OR user.name LIKE ' . $search .
					' OR user.username LIKE ' . $search .
					' OR uni.name LIKE ' . $search . ' )'
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
