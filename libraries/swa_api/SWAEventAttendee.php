<?php

interface SWAEventAttendee {

	public function getMember();
	public function getEvent();
	
	public function getDatePaid();
	public function setDatePaid($date);
	
	public function getAmountPaid();
	public function setAmountPaid($amount);
	
	public function getAbilityLevel();
	public function setAbilityLevel($level);

	public function isRacing();
	public function setRacing($bool);
	
	public function isWaving();
	public function setWaving($bool);
	
	public function isFreestyling();
	public function setFreestyling($bool);
	
	public function getTeam();
	public function setTeam($team);
	
}

?>