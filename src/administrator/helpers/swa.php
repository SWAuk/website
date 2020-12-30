<?php
defined('_JEXEC') or die;

/**
 * Swa helper.
 */
class SwaHelper
{

	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('Members'),
			'index.php?option=com_swa&view=members',
			$vName == 'members'
		);
		JHtmlSidebar::addEntry(
			JText::_('Memberships'),
			'index.php?option=com_swa&view=memberships',
			$vName == 'memberships'
		);
		JHtmlSidebar::addEntry(
			JText::_('Events'),
			'index.php?option=com_swa&view=events',
			$vName == 'events'
		);
		JHtmlSidebar::addEntry(
			JText::_('Event Tickets'),
			'index.php?option=com_swa&view=eventtickets',
			$vName == 'eventtickets'
		);
		JHtmlSidebar::addEntry(
			JText::_('Event Hosts'),
			'index.php?option=com_swa&view=eventhosts',
			$vName == 'eventhosts'
		);
		JHtmlSidebar::addEntry(
			JText::_('Event Registrations'),
			'index.php?option=com_swa&view=eventregistrations',
			$vName == 'eventregistrations'
		);
		JHtmlSidebar::addEntry(
			JText::_('Tickets'),
			'index.php?option=com_swa&view=tickets',
			$vName == 'tickets'
		);
		JHtmlSidebar::addEntry(
			JText::_('Universities'),
			'index.php?option=com_swa&view=universities',
			$vName == 'universities'
		);
		JHtmlSidebar::addEntry(
			JText::_('Competitions'),
			'index.php?option=com_swa&view=competitions',
			$vName == 'competitions'
		);
		JHtmlSidebar::addEntry(
			JText::_('Team Results'),
			'index.php?option=com_swa&view=teamresults',
			$vName == 'teamresults'
		);
		JHtmlSidebar::addEntry(
			JText::_('Individual Results'),
			'index.php?option=com_swa&view=individualresults',
			$vName == 'individualresults'
		);
		JHtmlSidebar::addEntry(
			JText::_('Committee'),
			'index.php?option=com_swa&view=committeemembers',
			$vName == 'committeemembers'
		);
		JHtmlSidebar::addEntry(
			JText::_('Competition Types'),
			'index.php?option=com_swa&view=competitiontypes',
			$vName == 'competitiontypes'
		);
		JHtmlSidebar::addEntry(
			JText::_('Seasons'),
			'index.php?option=com_swa&view=seasons',
			$vName == 'seasons'
		);
		JHtmlSidebar::addEntry(
			JText::_('Qualifications'),
			'index.php?option=com_swa&view=qualifications',
			$vName == 'qualifications'
		);
		JHtmlSidebar::addEntry(
			JText::_('Deposits'),
			'index.php?option=com_swa&view=deposits',
			$vName == 'deposits'
		);
		JHtmlSidebar::addEntry(
			JText::_('Damages'),
			'index.php?option=com_swa&view=damages',
			$vName == 'damages'
		);
		JHtmlSidebar::addEntry(
			JText::_('Grants'),
			'index.php?option=com_swa&view=grants',
			$vName == 'grants'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_swa';

		$actions = array(
			'core.admin',
			'core.manage',
			'core.create',
			'core.edit',
			'core.edit.own',
			'core.edit.state',
			'core.delete',
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}

}
