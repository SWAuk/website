<?php

interface SWAClub {

	public function getID();
	
	public function getName();
	public function setName($name);
	
	public function getWebURL();
	public function setWebURL($url);
	
	public function getFreshcode();
	public function setFreshcode($code);

}