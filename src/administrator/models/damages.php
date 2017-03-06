<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelDamages extends JModelList {

	/**
	 * @param array $config An optional associative array of configuration settings.
	 *
	 * @see        JController
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array(
				'id',
				'university',
				'event',
				'date',
				'cost',

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
		parent::populateState( 'damages.id', 'desc' );
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
					array('uni.name', 'event.name', 'event.date', 'damages.cost', 'damages.id'),
					array('university', 'event', 'date', 'cost', 'id')
				)
			)
		);
		$query->from( '`#__swa_damages` AS damages' );
		$query->leftJoin( $db->quoteName('#__swa_university','uni') . 'ON uni.id = damages.university_id');
		$query->leftJoin( $db->quoteName('#__swa_event', 'event') . 'ON event.id = damages.event_id' );

		// Filter by search in title
		// clean up the search term
		$search = trim($this->getState( 'filter.search' ));
		// replace 2 or more consecutive whitespaces with a single space
		$search = preg_replace('/\s{2,}/', ' ', $search);

		// replace the current search term with the cleaned up one
		$this->setState('filter.search', $search);

		if ( !empty( $search ) ) {
			if ( stripos( $search, 'id:' ) === 0 ) {
				$query->where( $db->quoteName('id') . ' = ' . (int)substr( $search, 3 ) );
			} else {
				$search = $db->quote( '%' . $db->escape( $search, true ) . '%' );
				$search = str_replace(' ', '%', $search);

				$query->where(
					'(' . $db->quoteName('university') . ' LIKE ' . $search .
					' OR ' . $db->quoteName('event') . ' LIKE ' . $search .
					' OR ' . $db->quoteName('date') . ' LIKE ' . $search .
					' OR ' . $db->quoteName('cost') . ' LIKE ' . $search . ' )'
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
