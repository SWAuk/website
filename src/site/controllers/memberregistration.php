<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerMemberRegistration extends SwaController {

	public function submit() {
		// Check for request forgeries.
		JSession::checkToken() or jexit( JText::_( 'JINVALID_TOKEN' ) );

		// Initialise variables.
		$app = JFactory::getApplication();
		$model = $this->getModel( 'MemberRegistration', 'SwaModel' );

		// Get the user data.
		$data = JFactory::getApplication()->input->get( 'jform', array(), 'array' );

		// Inject the current user ID here
		$data['user_id'] = JFactory::getUser()->id;
		if ( $data['user_id'] == 0 ) {
			throw new Exception( 'Cant register user with id of 0' );
		}

		// Validate the posted data.
		$form = $model->getForm();
		if ( !$form ) {
			JError::raiseError( 500, $model->getError() );

			return false;
		}

		// Validate the posted data.
		$data = $model->validate( $form, $data );

		// Check for errors.
		if ( $data === false ) {
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ( $i = 0, $n = count( $errors ); $i < $n && $i < 3; $i++ ) {
				if ( $errors[$i] instanceof Exception ) {
					$app->enqueueMessage( $errors[$i]->getMessage(), 'warning' );
				} else {
					$app->enqueueMessage( $errors[$i], 'warning' );
				}
			}

			$input = $app->input;
			$jform = $input->get( 'jform', array(), 'ARRAY' );

			// Save the data in the session.
			$app->setUserState( 'com_swa.edit.memberregistration.data', $jform, array() );

			// Redirect back to the edit screen.
			$this->setRedirect(
				JRoute::_( 'index.php?option=com_swa&view=memberregistration', false )
			);

			return false;
		}

		// Attempt to save the data.
		$return = $model->save( $data );

		// Check for errors.
		if ( $return === false ) {
			// Save the data in the session.
			$app->setUserState( 'com_swa.edit.memberregistration.data', $data );

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState( 'com_swa.edit.memberregistration.id' );
			$this->setMessage( JText::sprintf( 'Save failed', $model->getError() ), 'warning' );
			$this->setRedirect(
				JRoute::_(
					'index.php?option=com_swa&view=memberregistration&layout=edit&id=' . $id,
					false
				)
			);

			return false;
		} else {
			$this->logAuditFrontend( 'registered their membership details' );
		}

		// Check in the profile.
		if ( $return ) {
			$model->checkin( $return );
		}

		// Clear the profile id from the session.
		$app->setUserState( 'com_swa.edit.memberregistration.id', null );

		// Redirect to the list screen.
		$this->setMessage( JText::_( 'COM_SWA_ITEM_SAVED_SUCCESSFULLY' ) );
		$menu = JFactory::getApplication()->getMenu();
		$item = $menu->getActive();
		$url =
			( empty( $item->link ) ? 'index.php?option=com_swa&view=memberpayment' : $item->link );
		$this->setRedirect( JRoute::_( $url, false ) );

		// Flush the data from the session.
		$app->setUserState( 'com_swa.edit.memberregistration.data', null );
	}

}