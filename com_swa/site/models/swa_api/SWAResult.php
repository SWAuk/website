<?php
namespace SWA;

interface SWAResult {

	public function getEvent();
	public function getSeason();
	
	public function getPoints();
	public function setPoints($points);

}