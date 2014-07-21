<?php
namespace SWA;

interface SWAEventDamage {

	public function getEvent();
	
	public function getTime();
	public function setTime($time);
	
	public function getImbeciles();
	public function setImbeciles($club);
	
	public function getClaimant();
	public function setClaimant($name);
	
	public function getNature();
	public function setNature($details);

}