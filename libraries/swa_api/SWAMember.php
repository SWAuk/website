<?php

interface SWAMember {

	public function getUser();
	
	public function getFirstName();
	public function setFirstName($name);
	
	public function getLastName();
	public function setLastName($name);
	
	public function getSex();
	public function setSex($sex);
	
	public function getClub();
	public function setClub($club);
	
	public function getCourse();
	public function setCourse($course);
	
	public function getLevel();
	public function setLevel($level);
	
	public function getDiscipline();
	public function setDiscipline($discipline);
	
	public function getInstructorLevel();
	public function setInstructorLevel();
	
	public function getShirtSize();
	public function setShirtSize($size);
	
	public function getDOB();
	
	public function hasPaid();
	public function setPaid($bool);
	
	public function getMobile();
	public function setMobile($number);
	
	public function getEmergencyContact();
	public function setEmergencyContact($name);
	
	public function getEmergencyPhone();
	public function setEmergencyPhone($number);

}