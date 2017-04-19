<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelEvents extends SwaModelList {

	/**
	 * @param array $config An optional associative array of configuration settings.
	 *
	 * @see        JController
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array(
				'id',
				'a.id',
				'name',
				'a.name',
				'url',
				'a.url',
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
		$app = JFactory::getApplication();

		// Load the filter state.
		$search =
			$app->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' );
		$this->setState( 'filter.search', $search );

		// Load the parameters.
		$params = JComponentHelper::getParams( 'com_swa' );
		$this->setState( 'params', $params );

		// List state information.
		parent::populateState( 'event.id', 'desc' );
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

		$query->select( $db->quoteName(
			array('event.id', 'event.name', 'event.date', 'season.year', 'event_ticket.id'),
			array('id', 'name', 'date', 'season_year', 'event_ticket')
		));
		$query->from( $db->quoteName('#__swa_event', 'event') );
		$query->leftJoin( $db->quoteName('#__swa_season', 'season') . ' ON season.id = event.season_id' );
		$query->leftJoin( $db->quoteName('#__swa_event_ticket', 'event_ticket') . ' ON event_ticket.event_id = event.id' );
		$query->group( 'event.id' );
		$query->order( $this->getState( 'list.ordering' ) . ' ' . $this->getState( 'list.direction' ) );

		return $query;
	}

	public function getItems() {
		//NEVER limit this list
		$this->setState( 'list.limit', '0' );

		$items = parent::getItems();

		return $items;
	}

}
