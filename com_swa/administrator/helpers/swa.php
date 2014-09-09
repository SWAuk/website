<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * Swa helper.
 */
class SwaHelper {

	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu( $vName = '' ) {
		JHtmlSidebar::addEntry(
			JText::_( 'Members' ),
			'index.php?option=com_swa&view=members',
			$vName == 'members'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Instructors' ),
			'index.php?option=com_swa&view=instructors',
			$vName == 'instructors'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Events' ),
			'index.php?option=com_swa&view=events',
			$vName == 'events'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Event tickets' ),
			'index.php?option=com_swa&view=eventtickets',
			$vName == 'eventtickets'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Tickets' ),
			'index.php?option=com_swa&view=tickets',
			$vName == 'tickets'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Ticket types' ),
			'index.php?option=com_swa&view=tickettypes',
			$vName == 'tickettypes'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Deposits' ),
			'index.php?option=com_swa&view=deposits',
			$vName == 'deposits'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Damages' ),
			'index.php?option=com_swa&view=damages',
			$vName == 'damages'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Grants' ),
			'index.php?option=com_swa&view=grants',
			$vName == 'grants'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Universities' ),
			'index.php?option=com_swa&view=universities',
			$vName == 'universities'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Seasons' ),
			'index.php?option=com_swa&view=seasons',
			$vName == 'seasons'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Races' ),
			'index.php?option=com_swa&view=races',
			$vName == 'races'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Race types' ),
			'index.php?option=com_swa&view=racetypes',
			$vName == 'racetypes'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Team results' ),
			'index.php?option=com_swa&view=teamresults',
			$vName == 'teamresults'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'Individual results' ),
			'index.php?option=com_swa&view=individualresults',
			$vName == 'individualresults'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 * @since    1.6
	 */
	public static function getActions() {
		$user = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_swa';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ( $actions as $action ) {
			$result->set( $action, $user->authorise( $action, $assetName ) );
		}

		return $result;
	}

}
