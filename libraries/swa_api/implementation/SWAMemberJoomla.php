<?php
namespace SWA\Joomla;

require_once '../SWAMember.php';

class SWAMemberJoomla implements SWAMember {

	private $user;
	private $first_name;
	private $last_name;
	private $sex;
	private $club;
	private $course;
	private $level;
	private $discipline;
	private $instructor_level;
	private $shirt_size;
	private $dob;
	private $paid;
	private $mobile;
	private $emergency_contact;
	private $emergency_phone;
	
	public function __construct($user) {
		$this->user = $user;
	}

}