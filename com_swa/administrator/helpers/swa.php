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
			JText::_( 'COM_SWA_TITLE_UNIVERSITIES' ),
			'index.php?option=com_swa&view=universities',
			$vName == 'universities'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_SEASONS' ),
			'index.php?option=com_swa&view=seasons',
			$vName == 'seasons'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_EVENTS' ),
			'index.php?option=com_swa&view=events',
			$vName == 'events'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_TICKETTYPES' ),
			'index.php?option=com_swa&view=tickettypes',
			$vName == 'tickettypes'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_RACETYPES' ),
			'index.php?option=com_swa&view=racetypes',
			$vName == 'racetypes'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_GRANTS' ),
			'index.php?option=com_swa&view=grants',
			$vName == 'grants'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_DAMAGES' ),
			'index.php?option=com_swa&view=damages',
			$vName == 'damages'
		);
		JHtmlSidebar::addEntry(
			JText::_( 'COM_SWA_TITLE_DEPOSITS' ),
			'index.php?option=com_swa&view=deposits',
			$vName == 'deposits'
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
