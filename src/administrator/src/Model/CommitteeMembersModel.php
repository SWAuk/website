<?php

namespace SwaUK\Component\Swa\Administrator\Model;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\QueryInterface;

defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class CommitteeMembersModel extends ListModel {

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see        BaseController
	 */
	public function __construct( $config = array() ) {
		if ( empty( $config['filter_fields'] ) )
		{
			$config['filter_fields'] = array(
				'id',
				'member',
				'position',
				'ordering',
			);
		}

		parent::__construct( $config );
	}

	protected function populateState( $ordering = 'a.id', $direction = 'asc' ): void {
		$this->setState(
			'filter.search',
			$this->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' )
		);
		$this->setState( 'params', ComponentHelper::getParams( 'com_swa' ) );
		parent::populateState( $ordering, $direction );
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return    string        A store id.
	 */
	protected function getStoreId( $id = '' ): string {
		// Compile the store id.
		$id .= ':' . $this->getState( 'filter.search' );

		return parent::getStoreId( $id );
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return    \Joomla\Database\QueryInterface
	 */
	protected function getListQuery() {
		Log::add("getting commem list query");
		// Create a new query object.
		$db    = $this->getDatabase();
		$query = $db->getQuery( true );

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'DISTINCT a.*'
			)
		);
		$query->from( '`#__swa_committee` AS a' );
		$query->join( 'LEFT', '`#__swa_member` AS member ON a.member_id=member.id' );
		$query->join( 'LEFT', '`#__users` AS user ON member.user_id=user.id' );
		$query->select( 'user.name as member' );

		// Filter by search in title
		$search = $this->getState( 'filter.search' );
		if ( ! empty( $search ) )
		{
			if ( stripos( $search, 'id:' ) === 0 )
			{
				$query->where( 'a.id = ' . (int) substr( $search, 3 ) );
			}
			else
			{
				$search = $db->Quote( '%' . $db->escape( $search, true ) . '%' );
				$query->where(
					'( a.position LIKE ' . $search .
					'  OR  user.name LIKE ' . $search .
					'  OR  user.username LIKE ' . $search . ' )'
				);
			}
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get( 'list.ordering' );
		$orderDirn = $this->state->get( 'list.direction' );
		if ( $orderCol && $orderDirn )
		{
			$query->order( $db->escape( $orderCol . ' ' . $orderDirn ) );
		}
		Log::add($query->toQuerySet());
		Log::add(json_encode($query));
		return $query;
	}

	public function getItems() {
		return parent::getItems();
	}

}
