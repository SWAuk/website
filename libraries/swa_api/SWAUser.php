<?phpinterface SWAUser {	public function getUsername();		public function setPassword($password);		public function getEmail();	public function setEmail($email);		public function getGroups();	public function setGroups($groups);	public function addGroup($group);	public function removeGroup($group);}