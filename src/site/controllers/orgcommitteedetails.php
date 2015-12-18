<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerOrgcommitteedetails extends SwaController {

	public function submit() {
		// Check for request forgeries.
		JSession::checkToken() or jexit( JText::_( 'JINVALID_TOKEN' ) );

		/** @var SwaModelOrgCommitteeDetails $model */
		$model = $this->getModel( 'OrgCommitteeDetails' );

		$member = $model->getMember();
		if ( !is_object( $member ) ) {
			throw new Exception( 'You must be a member to view this page.' );
		}
		if ( !$member->swa_committee ) {
			throw new Exception( 'You must be an SWA committee member to view this page.' );
		}

		$input = JFactory::getApplication()->input;
		$data = $input->getArray();

		$committeeDetailsId = $data['jform']['id'];
		$submittedMemberId = $data['jform']['member_id'];
		$newBlurb = $data['jform']['blurb'];

		if( $submittedMemberId != $member->id ) {
			throw new Exception( 'Your trying to submit data for someone else?' );
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery( true );

		$query
			->update( $db->quoteName( '#__swa_committee' ) )
			->where( 'id = ' . $db->quote( $committeeDetailsId ) )
			->set( 'blurb = ' . $db->quote( $newBlurb ) );

		$db->setQuery( $query );
		if ( !$db->execute() ) {
			JLog::add(
				__CLASS__ . ' failed to update committee details: ' . $committeeDetailsId,
				JLog::INFO,
				'com_swa'
			);
		} else {

			$this->logAuditFrontend( 'Updated committee details ' . $committeeDetailsId );
		}
		$this->setRedirect(
			JRoute::_( 'index.php?option=com_swa&view=orgcommitteedetails&layout=default', false )
		);
	}

}