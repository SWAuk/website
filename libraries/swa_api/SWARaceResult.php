<?php
namespace SWA;

require_once 'SWAResult.php';

interface SWARaceResult extends SWAResult {

	public function getMember();

}