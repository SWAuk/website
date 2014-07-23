<?php

interface SWAEvent {

	public function getID();
	public function getName();
	
	public function getOpenDate();
	public function setOpenDate($date);
	
	public function getStartDate();
	public function setStartDate($date);
	
	public function getEndDate();
	public function setEndDate($date);
	
	public function getSeason();
	
	public function getOrganisers();
	public function setOrganisers($organisers);
	
	public function getLocation();
	public function setLocation($location);
	
	public function hasRaces();
	public function setHasRaces($bool);
	
	public function hasTeamRaces();
	public function setHasTeamRaces($bool);
	
	public function hasWave();
	public function setHasWave($bool);
	
	public function hasFreestyle();
	public function setHasFreestyle($bool);
	
	public function getUniLimit();
	public function setUniLimit($limit);
	
	public function getEventMax();
	public function setEventMax($limit);
	
	public function getEventMaxBeg();
	public function setEventMaxBeg($limit);
	
	public function getEventMaxInt();
	public function setEventMaxInt($limit);
	
	public function getEventMaxAdv();
	public function setEventMaxAdv($limit);
	
	public function getEventMaxXSWA();
	public function setEventMaxXSWA($limit);
	
	public function getPrice();
	public function setPrice($price);
	
	public function getHostPrice();
	public function setHostPrice($price);
	
	public function getCommitteePrice();
	public function setCommitteePrice($price);
	
	public function getXSWAPrice();
	public function setXSWAPrice($price);
	
	public function getInstructorPrice();
	public function setInstructorPrice($price);

}