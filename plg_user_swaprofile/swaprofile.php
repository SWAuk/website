<?php 
defined('JPATH_BASE') or die;

/**
 * SWA custom profile plugin.
 */
class plgUserSWAProfile extends JPlugin
{
	function onContentPrepareData($context, $data)
	{
		// Check we are manipulating a valid form.
		if (!in_array($context, array('com_users.profile','com_users.registration','com_users.user','com_admin.profile'))){
			return true;
		}
 
		$userId = isset($data->id) ? $data->id : 0;
 
		// Load the profile data from the database.
		$db = &JFactory::getDbo();
		$db->setQuery(
			'SELECT profile_key, profile_value FROM #__user_profiles' .
			' WHERE user_id = '.(int) $userId .
			' AND profile_key LIKE \'swaprofile.%\'' .
			' ORDER BY ordering'
		);
		$results = $db->loadRowList();
 
		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->_subject->setError($db->getErrorMsg());
			return false;
		}
 
		// Merge the profile data.
		$data->swaprofile = array();
		foreach ($results as $v) {
			$k = str_replace('swaprofile.', '', $v[0]);
			$data->swaprofile[$k] = $v[1];
		}
 
		return true;
	}

	/**
	 * @param $form JForm The form to be altered.
	 * @param $data array The associated data for the form.
	 * @return boolean
	 */
	function onContentPrepareForm($form, $data)
	{
		// Load user_profile plugin language
		$lang = JFactory::getLanguage();
		$lang->load('plg_user_swaprofile', JPATH_ADMINISTRATOR);

		if (!($form instanceof JForm)) {
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}
		// Check we are manipulating a valid form.
		if (!in_array($form->getName(), array('com_users.profile', 'com_users.registration','com_users.user','com_admin.profile'))) {
			return true;
		}
		if ($form->getName()=='com_users.profile')
		{
			// Add the profile fields to the form.
			JForm::addFormPath(dirname(__FILE__).'/profiles');
			$form->loadFile('profile', false);

			// Toggle whether the something field is required.
			if ($this->params->get('profile-require_something', 1) > 0) {
				$form->setFieldAttribute('something', 'required', $this->params->get('profile-require_something') == 2, 'swaprofile');
			} else {
				$form->removeField('something', 'swaprofile');
			}
		}

		//In this example, we treat the frontend registration and the back end user create or edit as the same.
		elseif ($form->getName()=='com_users.registration' || $form->getName()=='com_users.user' )
		{
			// Add the registration fields to the form.
			JForm::addFormPath(dirname(__FILE__).'/profiles');
			$form->loadFile('profile', false);

			// Toggle whether the something field is required.
			if ($this->params->get('register-require_something', 1) > 0) {
				$form->setFieldAttribute('something', 'required', $this->params->get('register-require_something') == 2, 'swaprofile');
			} else {
				$form->removeField('something', 'swaprofile');
			}
		}
	}
 
	function onUserAfterSave($data, $isNew, $result, $error)
	{
		$userId	= JArrayHelper::getValue($data, 'id', 0, 'int');
 
		if ($userId && $result && isset($data['swaprofile']) && (count($data['swaprofile'])))
		{
			try
			{
				$db = &JFactory::getDbo();
				$db->setQuery('DELETE FROM #__user_profiles WHERE user_id = '.$userId.' AND profile_key LIKE \'swaprofile.%\'');
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
 
				$tuples = array();
				$order	= 1;
				foreach ($data['swaprofile'] as $k => $v) {
					$tuples[] = '('.$userId.', '.$db->quote('swaprofile.'.$k).', '.$db->quote($v).', '.$order++.')';
				}
 
				$db->setQuery('INSERT INTO #__user_profiles VALUES '.implode(', ', $tuples));
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
			}
			catch (JException $e) {
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}
 
		return true;
	}

	/**
	 * Remove all user profile information for the given user ID
	 *
	 * Method is called after user data is deleted from the database
	 *
	 * @param       array           $user           Holds the user data
	 * @param       boolean         $success        True if user was succesfully stored in the database
	 * @param       string          $msg            Message
	 */
	function onUserAfterDelete($user, $success, $msg)
	{
		if (!$success) {
			return false;
		}
 
		$userId	= JArrayHelper::getValue($user, 'id', 0, 'int');
 
		if ($userId)
		{
			try
			{
				$db = JFactory::getDbo();
				$db->setQuery(
					'DELETE FROM #__user_profiles WHERE user_id = '.$userId .
					" AND profile_key LIKE 'swaprofile.%'"
				);
 
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
			}
			catch (JException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}
 
		return true;
	}
  
}

