<?php

require_once '../SWAEventGrant.php';

class SWAEventGrantJoomla implements SWAEventGrant {
	
	private $id;
	private $applicant;
	private $application_date;
	private $event;
	private $amount;
	private $fund_use;
	private $instructions;
	
	private $ac_sort_code;
	private $ac_account_num;
	private $ac_name;
	
	private $finances_date;
	private $finances_id;
	
	private $authorisation_date;
	private $authorisation_id;
	
	private $payment_date;
	private $payment_id;
	
}