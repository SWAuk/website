<?php

class SWAEventGrant {
	
	public function getID();
	public function getApplicant();
	public function getApplicationDate();
	public function getEvent();
	public function getAmount();
	
	public function getFundUse();
	public function setFundUse($details);
	
	public function getInstructions();
	public function setInstructions($instructions);
	
	public function getAcSortCode();
	public function setAcSortCode($sortcode);
	
	public function getAcAccountNum();
	public function setAcAccountNum($num);
	
	public function getAcName();
	public function setAcName($name);
	
	public function getFinancesDate();
	public function setFinancesDate($date);
	
	public function getFinancesID();
	public function setFinancesID($id);
	
	public function getAuthorisationDate();
	public function setAuthorisationDate($date);
	
	public function getAuthorisationID();
	public function setAuthorisationID($id);
	
	public function getPaymentDate();
	public function setPaymentDate($date);
	
	public function getPaymentID();
	public function setPaymentID($id);
	
}