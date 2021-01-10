<!-- 
This payment process is based off the 'Custom Payment Flow' at the following stipe site. 
https://stripe.com/docs/payments/accept-a-payment?integration=elements

A tutorial is available here (at the time of writing):
https://stripe.com/docs/payments/integration-builder
-->
<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerMemberPayment extends SwaController
{

	public function createPaymentIntent()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		/** @var SwaModelMemberPayment $model */
		$model  = $this->getModel('MemberPayment');
		$member = $model->getMember();

		// Check successfully got the user and all the info we need to process the transaction
		if (!$user || !isset($user->id) || !isset($user->name) || !isset($user->email)) {
			$message = "Unable to retrieve user. " . var_export($user, true);
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Unable to identify user. Please contact webmaster@swa.co.uk if this problem continues.";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}

		// Check successfully got the user and all the info we need to process the transaction
		if ($member->paid) {
			$error_msg = "You have already paid for membership. You have not been charged again. \n\r
			Please contact webmaster@swa.co.uk if there is a problem";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}

		try {
			$paymentIntent = \Stripe\PaymentIntent::create(
				array(
					'description'          => "SWA Membership for {$user->name}",
					'amount'               => 500,
					'currency'             => 'GBP',
					'receipt_email'        => $user->email,
					'statement_descriptor' => "SWA Membership",
					'metadata'             => array(
						'user_id'   => $user->id,
						'user_name' => $user->name
					)
				)
			);
			$output = [
				'clientSecret' => $paymentIntent->client_secret,
			];
			echo new \Joomla\CMS\Response\JsonResponse($output);
			jexit();
		}
		catch (Error $e) {
			$message = "User tried to buy membership but the paymentIntent was not created successfully: {$e->getMessage()}";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Oops! There was an unknown error setting up the payment - please refresh the page to try again.\r\n";
			$error_msg .= "Contact webmaster@swa.co.uk if this continues to happen.";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}

		jexit();
	}

	public function setMemberPaid()
	{
		$app = JFactory::getApplication();
		$jinput = $this->input->json;
		$paymentIntentId = $jinput->get('paymentIntentId', "", 'string');
		$paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
		$model  = $this->getModel('MemberPayment');
		$member = $model->getMember();
		$member_id = $member->id;

		if ($paymentIntent->status != 'succeeded') {
			$message = "PaymentIntent creation did not succeed or is still processing and so the user was prevented from 
			completing payment. You should check this payment and the database to make sure the user was not charged
			and membership was not bought";
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			$error_msg = "Payment failed. You should not have been charged. \r\nPlease contact webmaster@swa.co.uk
			for assistance and to confirm no payment has been taken. Do not try again.";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		};

		// Update the membership status for the member!
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$now        = time();
		$seasonEnd  = strtotime("1st June");
		$seasonName = $now < $seasonEnd ? date("Y", strtotime('-1 year', $now)) : date("Y", $now);

		$subQuery = $db->getQuery(true)
			->select($db->qn('id'))
			->from($db->qn('#__swa_season', 'season'))
			->where($db->qn('season.year') . ' LIKE "' . $seasonName . '%"');

		$columns = array('member_id', 'season_id');
		$values  = array($db->q($member_id), '(' . $subQuery . ')');

		$query
			->insert($db->quoteName('#__swa_membership'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);
		$result = $db->execute();

		if ($result === false) {
			JLog::add(
				"MemberPayment authorized but failed to update db. member_id: {$member_id}",
				JLog::ERROR,
				'com_swa.payment_process'
			);
			$error_msg = "Oops! There was an error  - DO NOT try again!\r\n";
			$error_msg .= "Membership purchase FAILED but a payment MAY have been taken.\r\n";
			$error_msg .= "Please contact webmaster@swa.co.uk ASAP to resolve this.\r\n";
			$app->enqueueMessage($error_msg, 'error');
			echo new \Joomla\CMS\Response\JsonResponse(null, "", true);
			jexit();
		}

		$this->logAuditFrontend("Member({$member_id}) bought their membership for Season({$seasonName})");
		echo new \Joomla\CMS\Response\JsonResponse(null);
		// $app->enqueueMessage('Membership paymernt successful!', 'success');
		// $app->redirect(JRoute::_('index.php?option=com_swa&view=ticketpurchase'));
		jexit();
	}
}
