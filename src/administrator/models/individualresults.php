<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelIndividualresults extends JModelList {

	/**
	 * @param array $config An optional associative array of configuration settings.
	 *
	 * @see        JController
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array(
				'id',
				'user',
				'event',
				'result'
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
		parent::populateState( 'id', 'desc' );
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
					array('result.id', 'user.name', 'event.name', 'competition_type.name', 'result.result'),
					array('id', 'user', 'event', 'competition_type', 'result')
				)
			)
		);
		$query->from( $db->quoteName('#__swa_indi_result', 'result') );
		$query->leftJoin( $db->quoteName('#__swa_member', 'member') . ' ON member.id = result.member_id' );
		$query->leftJoin( $db->quoteName('#__users', 'user') . ' ON user.id = member.user_id' );
		$query->leftJoin(
			$db->quoteName('#__swa_competition', 'competition') . ' ON competition.id = result.competition_id'
		);
		$query->leftJoin( $db->quoteName('#__swa_event', 'event') . ' ON event.id = competition.event_id' );
		$query->leftJoin(
			$db->quoteName('#__swa_competition_type', 'competition_type')
			. ' ON competition_type.id = competition.competition_type_id'
		);

        // Filter by search in title
		// clean up the search term
		$search = trim($this->getState( 'filter.search' ));
		// replace 2 or more consecutive whitespaces with a single space
		$search = preg_replace('/\s{2,}/', ' ', $search);

		// replace the current search term with the cleaned up one
		$this->setState('filter.search', $search);

		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( $db->quoteName('result.id') . ' = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->quote( '%' . $db->escape( $search, true ) . '%' );
				$search = str_replace(' ', '%', $search);

				$query->where(
					'(' . $db->quoteName('user_id.name') . ' LIKE ' . $search .
					' OR ' . $db->quoteName('competition_type.name') . ' LIKE ' . $search .
					' OR ' . $db->quoteName('event.name') . ' LIKE ' . $search . ' )'
				);
			}
		}

		// Add the list ordering clause.
		$orderCol = $this->state->get( 'list.ordering' );
		$orderDirn = $this->state->get( 'list.direction' );
		if ( $orderCol && $orderDirn ) {
			$query->order( $db->escape( $orderCol . ' ' . $orderDirn ) );
		}
//		printf($query->dump());
//		die;
		return $query;
	}

	public function getItems() {
		$items = parent::getItems();

		return $items;
	}

}
