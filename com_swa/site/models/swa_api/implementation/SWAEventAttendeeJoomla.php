<?php
namespace SWA\Joomla;

require_once '../SWAEventAttendee.php';

class SWAEventAttendeeJoomla implements SWAEventAttendee {

	private $member;
	private $event;
	private $date_paid;
	private $amount;
	private $event_level;

	private $is_racing;
	private $is_waving;
	private $is_freestyling;
	private $team;
	
}