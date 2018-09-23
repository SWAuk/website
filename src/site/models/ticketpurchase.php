<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SwaModelTicketPurchase extends SwaModelList
{

	/**
	 * @return JTable|mixed
	 */
	public function getMember()
	{
		if (!isset($this->member))
		{
			// Create a new query object.
			$db    = $this->getDbo();
			$query = $db->getQuery(true);
			$user  = JFactory::getUser();

			// Select the required fields from the table.
			$query->select('a.*');
			$query->from($db->qn('#__swa_member', 'a'));
			$query->where('a.user_id = ' . $user->id);
			$query->group($db->qn('a.id'));

			// Join on committee table
			$query->leftJoin('#__swa_committee as committee on committee.member_id = a.id');
			$query->select('!ISNULL(committee.id) as swa_committee');

			// Join onto the university_member table
			$query->leftJoin(
				$db->quoteName('#__swa_university_member') . ' AS b ON a.id = b.member_id'
			);
			$query->select('b.graduated as graduated');
			$query->select('count( b.id ) as confirmed_university');
			$query->select('b.committee as club_committee');

			// Get qualification info
			$subQuery = $db->getQuery(true);
			$subQuery->select('COUNT(*)');
			$subQuery->from($db->quoteName('#__swa_qualification') . ' AS qualification');
			$subQuery->where('qualification.member_id = b.member_id');
			$subQuery->where('qualification.expiry_date > NOW()');
			$subQuery->where('qualification.approved=1');
			$query->select('(' . $subQuery->__toString() . ') as qualification');

			// Get event ids registered for!
			$query->join(
				'LEFT',
				'#__swa_event_registration AS event_registration ON event_registration.member_id = a.id'
			);
			$query->select(
				'GROUP_CONCAT( DISTINCT event_registration.event_id ) as registered_event_ids'
			);

			// Get event ids for tickets we have that are in the future
			$query->join('LEFT', '#__swa_ticket AS ticket ON ticket.member_id = a.id');
			$query->join(
				'LEFT',
				'#__swa_event_ticket AS event_ticket ON ticket.event_ticket_id = event_ticket.id'
			);
			$query->join('LEFT', '#__swa_event AS event ON event_ticket.event_id = event.id');
			$query->select(
				'GROUP_CONCAT( CASE WHEN event.date > NOW() THEN event_ticket.event_id END ) as ticketed_event_ids'
			);

			$now       = time();
			$seasonEnd = strtotime("1st June");
			$date      = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

			// Join on membership table
			$query->leftJoin('#__swa_membership AS membership ON membership.member_id = a.id');
			$query->select('membership.season_id');
			$query->leftJoin('#__swa_season AS season ON membership.season_id = season.id');
			$query->where('(season.year LIKE "' . (int) $date . '%" OR membership.season_id IS NULL)');

			// Load the result
			$db->setQuery($query);
			$this->member = $db->loadObject();

			//
			if ($this->member !== null)
			{
				$this->member->paid = $this->member->season_id != null || $this->member->lifetime_member;
			}
		}

		return $this->member;
	}

	public function getListQuery()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Adam XXX, Added lines below to cover the change in var!!!
		$query->select('a.details AS details');
		$query->select('event.name AS event_name');
		$query->select('event.date_open AS ticket_open');
		$query->select('event.date_close AS ticket_close');
		$query->select('event.capacity AS event_capacity');
		$query->select('a.quantity AS ticket_quantity');

		// $query->select( 'COUNT(ticket.id) AS tickets_sold' );

		// Select all event tickets
		$query->select('a.id as id');
		$query->select('a.name as ticket_name');
		$query->select('a.price as price');
		$query->select('a.notes as notes');
		$query->select('a.need_level as need_level');
		$query->select('a.need_xswa as need_xswa');
		$query->select('a.need_swa as need_swa');
		$query->select('a.need_host as need_host');
		$query->select('a.need_qualification as need_qualification');
		$query->from($db->quoteName('#__swa_event_ticket') . ' AS a');

		// Select details of the event
		$query->innerJoin('#__swa_event as event ON a.event_id=event.id');
		$query->select('event.name as event');
		$query->select('event.id as event_id');
		$query->select('event.date as event_date');
		$query->select('event.date_close as event_close');
		$query->select('event.capacity as capacity');

		// Where we still have capacity left in the event
		$subQuerySold = $db->getQuery(true);
		$subQuerySold->select('COUNT( ticket.id )');
		$subQuerySold->from('#__swa_ticket as ticket');
		$subQuerySold->rightJoin('#__swa_event_ticket AS event_ticket ON ticket.event_ticket_id = event_ticket.id');
		$subQuerySold->where('event_ticket.event_id=event.id');
		$query->select('( ' . $subQuerySold->__toString() . ' ) as sold');
		$query->select('( event.capacity - ( ' . $subQuerySold->__toString() . ' ) ) as capacity_remaining');

		// Select details of the event hosts
		$query->join(
			'LEFT',
			'#__swa_event_host AS event_host ON event_host.event_id = a.event_id'
		);
		$query->select('GROUP_CONCAT( event_host.university_id ) as host_university_ids');
		$query->group('a.id');

		// Select event closed & open indicators
		$query->select('( event.date_close < NOW() ) as event_has_closed');
		$query->select('( event.date_open < NOW() ) as event_has_opened');

		// Where the event is in the future!
		$query->where('event.date > NOW()');

		// Where we still have tickets remaining
		$subQuery = $db->getQuery(true);
		$subQuery->select('COUNT( ticket.id )');
		$subQuery->from('#__swa_ticket as ticket');
		$subQuery->where('ticket.event_ticket_id=a.id');
		$query->select('( a.quantity - ( ' . $subQuery->__toString() . ' ) ) as quantity_remaining');
		$query->select('( ( ' . $subQuery->__toString() . ' ) ) as tickets_sold');

		return $query;
	}

	public function getItems()
	{
		// NEVER limit this list
		$this->setState('list.limit', '0');

		$tickets = parent::getItems();

		$member = $this->getMember();

		$allowedTickets   = array();
		$totalTicketsSold = array();

		// Count total number of tickets sold
		foreach ($tickets as $ticket)
		{
			@$totalTicketsSold[$ticket->event_id] += $ticket->tickets_sold;
		}

		foreach ($tickets as $ticket)
		{
			// Decode the json ticket details
			$ticket->details = json_decode($ticket->details);

			if ($ticket->details === null)
			{
				$ticket->details = new stdClass;
			}

			// Get whether the ticket should displayed and the reason it can't be bought if there is one
			list($displayTicket, $ticket->reason) = $this->memberAllowedToViewBuyTicket($member, $ticket);

			// If the event capacity is full display SOLD OUT message
			if ($totalTicketsSold[$ticket->event_id] >= $ticket->event_capacity)
			{
				$ticket->reason = 'Event currently SOLD OUT!';
			}

			// Only display tickets the member are allowed to see
			if ($displayTicket)
			{
				$allowedTickets[] = $ticket;
			}
		}

		return $allowedTickets;
	}

	/**
	 * Should the given user be allowed to view and buy the given ticket?
	 *
	 * Note: This could easily be tested at some point...
	 *
	 * @param   object $member
	 * @param   object $ticket
	 *
	 * @return array array($display, $reason)
	 */
	private function memberAllowedToViewBuyTicket($member, $ticket)
	{

		// Create an alias for ticket to reduce line length
		$t = $ticket;

		$display = true;
		$reason  = array();

		$isRegisteredForEvent = (in_array($t->event_id, explode(',', $member->registered_event_ids)));

		// Specifiy a timezone in code incase the server time is wrong
		$timezone    = new DateTimeZone('Europe/London');
		$dateNow     = new DateTime('now', $timezone);
		$ticketOpen  = new DateTime($t->ticket_open, $timezone);
		$ticketClose = new DateTime($t->ticket_close, $timezone);

		// Ticket sales close at midnight of the chosen day (hence the setTime)
		$ticketClose->setTime(23, 59, 59);

		// Check if the ticket should be displayed
		if (!isset($t->details->visible))
		{
			$t->details->visible = "All";
		}
		elseif ($t->details->visible == "None")
		{
			$reason  = 'No one can see this ticket';
			$display = false;

			return array($display, $reason);
		}
		elseif ($t->details->visible == "Committee" && !$member->swa_committee)
		{
			$reason  = 'You have to be SWA committee to see this ticket';
			$display = false;

			return array($display, $reason);
		}
		elseif ($t->need_swa && !$member->swa_committee)
		{
			// TODO delete when no longer using need_swa
			$reason  = 'You have to be SWA committee to buy this ticket';
			$display = false;

			return array($display, $reason);
		}

		// Check if any constraints on member whitelist
		if (!empty($t->details->member->whitelist)
			&& !in_array($member->id, $t->details->member->whitelist))
		{
			$reason = "This ticket is only available for specific members.";

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if any constraints on member blacklist
		if (!empty($t->details->member->blacklist)
			&& in_array($member->id, $t->details->member->blacklist))
		{
			$reason = "This ticket is only available for specific members.";

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if any constraints on university whitelist
		if (!empty($t->details->university->whitelist)
			&& !in_array($member->university_id, $t->details->university->whitelist))
		{
			$reason = "This ticket is only available for specific universities.";

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if any constraints on university blacklist
		if (!empty($t->details->university->blacklist)
			&& in_array($member->university_id, $t->details->university->blacklist))
		{
			$reason = "This ticket is only available for specific universities.";

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if any constraints on member's level whitelist
		if (!empty($t->details->level->whitelist)
			&& !in_array($member->level, $t->details->level->whitelist))
		{
			$reason = 'You need to be one of the following levels [';
			$reason .= implode(', ', $t->details->level->whitelist) . ']';

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if any constraints on member's level blacklist
		if (!empty($t->details->level->blacklist)
			&& in_array($member->level, $t->details->level->blacklist))
		{
			$reason = "You can't be one of the following levels [";
			$reason .= implode(', ', $t->details->level->blacklist) . ']';

			// Don't display if visible is set to "Match" and member is not committee
			if ($t->details->visible == "Match" && !$member->swa_committee)
			{
				$display = false;

				return array($display, $reason);
			}
		}

		// Check if member has already bought a ticket to that event
		if (in_array($t->event_id, explode(',', $member->ticketed_event_ids)))
		{
			$reason = "You have already bought a ticket to this event.";
		}
		elseif ($dateNow < $ticketOpen)
		{
			$reason = "Tickets sales haven't opened yet.";
		}
		elseif ($dateNow > $ticketClose)
		{
			$reason = "SALES CLOSED!";
		}
		elseif ($t->ticket_quantity <= $t->tickets_sold)
		{
			$reason = "Ticket currently SOLD OUT!";
		}
		elseif ($member->graduated && !$t->details->xswa)
		{
			$reason = "This ticket is not available to XSWA members.";
		}
		elseif (!$member->graduated && !$member->swa_committee && !$isRegisteredForEvent)
		{
			// Allow XSWA and SWA to buy tickets when not registered for the event
			$reason = "You have not been registered for this event by your club committee!";
		}
		elseif (isset($t->details->qualification) && $t->details->qualification && !$member->qualification)
		{
			$reason = "You need to have an approved qualification to buy this ticket.";
		}
		elseif ($t->need_qualification && !$member->qualification)
		{
			// TODO delete when no longer using these fields
			$reason = "You need to have an approved qualification to buy this ticket.";
		}
		elseif (isset($t->details->committee) && $t->details->committee && !$member->qualification)
		{
			$reason = "You need to be SWA Committee to buy this ticket.";
		}

		return array($display, $reason);
	}

}
