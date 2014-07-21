<?php
namespace SWA\Joomla;

require_once '../SWAEvent.php';

class SWAEventJoomla implements SWAEvent {

	private $id;
	private $name;
	private $open_date;
	private $start_date;
	private $end_date;
	private $season;
	private $organisers;
	private $location;
	
	private $race;
	private $freestyle;
	private $wave;
	private $team;
	
	private $uni_limit;
	private $event_max;
	private $event_max_beg;
	private $event_max_int;
	private $event_max_adv;
	private $event_max_xswa;
	
	private $price;
	private $host_price;
	private $committee_price;
	private $xswa_price;
	private $instructor_price;

}