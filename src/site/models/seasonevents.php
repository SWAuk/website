<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Methods supporting a list of Swa records.
 */
class SwaModelSeasonEvents extends JModelList {

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
				'name', 'a.name',
				'url', 'a.url',
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
		$search = $app->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' );
		$this->setState( 'filter.search', $search );

		// Load the parameters.
		$params = JComponentHelper::getParams( 'com_swa' );
		$this->setState( 'params', $params );

		// List state information.
		parent::populateState( 'a.name', 'asc' );
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

		//Get the current season year
		$seasonYear = $this->getCurrentSeasonYear();

		$query->select( array( 'event.name', 'event.date' ) );
		$query->from( '`#__swa_season` AS season' );
		$query->join( 'RIGHT', '#__swa_event as event ON season.id = event.season_id' );
		$query->where( 'season.year = ' . $seasonYear );

		return $query;
	}

	/**
	 * @return int The current season start year
	 */
	private function getCurrentSeasonYear() {
		$currentYear = intval( date( "Y" ) );
		$currentMonth = intval( date( "n" ) );//1-12
		// 1 July onwards counts as the new season
		if( $currentMonth <= 06 ) {
			return $currentYear - 1;
		}
		return $currentYear;
	}

	public function getItems() {
		$items = parent::getItems();

		return $items;
	}

}
