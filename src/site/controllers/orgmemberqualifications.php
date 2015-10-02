<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerOrgMemberQualifications extends SwaController {

	public function viewImage() {
		/** @var SwaModelOrgMemberQualifications $model */
		$model = $this->getModel( 'OrgMemberQualifications' );

		$member = $model->getMember();
		if ( !is_object( $member ) ) {
			throw new Exception( 'You must be a member to view this page.' );
		}
		if ( !$member->swa_committee ) {
			throw new Exception( 'You must be an SWA committee member to view this page.' );
		}

		$input = JFactory::getApplication()->input;
		$data = $input->getArray();
		$qualificationId = $data['qualification'];

		$db = JFactory::getDbo();
		$query = $db->getQuery( true );

		$query->select( 'a.*' );
		$query->from( '#__swa_qualification as a' );
		$query->where( 'id=' . $db->quote( $qualificationId ) );

		$db->setQuery( $query );
		if( !$db->execute() ) {
			die( 'something went wrong selecting the image' );
		}
		$qualification = $db->loadObject();

		//output the file?
		header("Content-type: " . $qualification->file_type );
		print( $qualification->file );
		exit();
	}

	public function approve() {
		// Check for request forgeries.
		JSession::checkToken() or jexit( JText::_( 'JINVALID_TOKEN' ) );

		/** @var SwaModelOrgMemberQualifications $model */
		$model = $this->getModel( 'OrgMemberQualifications' );

		$member = $model->getMember();
		if ( !is_object( $member ) ) {
			throw new Exception( 'You must be a member to view this page.' );
		}
		if ( !$member->swa_committee ) {
			throw new Exception( 'You must be an SWA committee member to view this page.' );
		}

		$input = JFactory::getApplication()->input;
		$data = $input->getArray();
		$qualificationId = $data['qualification'];

		$db = JFactory::getDbo();
		$query = $db->getQuery( true );

		$query
			->update( $db->quoteName( '#__swa_qualification' ) )
			->where( 'id = ' . $db->quote( $qualificationId ) )
			->set( 'approved=1' );

		$db->setQuery( $query );
		if ( !$db->execute() ) {
			JLog::add(
				__CLASS__ . ' failed to approve qualification: ' . $qualificationId,
				JLog::INFO,
				'com_swa'
			);
		} else {

			$this->logAuditFrontend( 'approved qualification ' . $qualificationId );
		}
		$this->setRedirect(
			JRoute::_( 'index.php?option=com_swa&view=orgmemberqualifications&layout=default', false )
		);
	}

	public function unapprove() {
		// Check for request forgeries.
		JSession::checkToken() or jexit( JText::_( 'JINVALID_TOKEN' ) );

		/** @var SwaModelOrgMemberQualifications $model */
		$model = $this->getModel( 'OrgMemberQualifications' );

		$member = $model->getMember();
		if ( !is_object( $member ) ) {
			throw new Exception( 'You must be a member to view this page.' );
		}
		if ( !$member->swa_committee ) {
			throw new Exception( 'You must be an SWA committee member to view this page.' );
		}

		$input = JFactory::getApplication()->input;
		$data = $input->getArray();
		$qualificationId = $data['qualification'];

		$db = JFactory::getDbo();
		$query = $db->getQuery( true );

		$query
			->update( $db->quoteName( '#__swa_qualification' ) )
			->where( 'id = ' . $db->quote( $qualificationId ) )
			->set( 'approved=0' );

		$db->setQuery( $query );
		if ( !$db->execute() ) {
			JLog::add(
				__CLASS__ . ' failed to unapprove qualification: ' . $qualificationId,
				JLog::INFO,
				'com_swa'
			);
		} else {

			$this->logAuditFrontend( 'unapproved qualification ' . $qualificationId );
		}
		$this->setRedirect(
			JRoute::_( 'index.php?option=com_swa&view=orgmemberqualifications&layout=default', false )
		);
	}

}