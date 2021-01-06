<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerMemberPayment extends SwaController
{

	public function createPaymentIntent()
	{
		$user = JFactory::getUser();
		/** @var SwaModelMemberPayment $model */
		$model  = $this->getModel('MemberPayment');
		$member = $model->getMember();

		// Check successfully got the user and all the info we need to process the transaction
		if (!$user || !isset($user->id) || !isset($user->name) || !isset($user->email)) {
			$message = "Unable to retrieve user. " . var_export($user, true);
			JLog::add($message, JLog::ERROR, 'com_swa.payment_process');
			http_response_code(500);
			echo json_encode(['error' => "Unable to identify user. Please contact webmaster@swa.co.uk if this problem continues."]);
			die();
		}

		// Check successfully got the user and all the info we need to process the transaction
		if ($member->paid) {
			http_response_code(500);
			echo json_encode(['error' => "You have alreaedy paid for membership. You have not been charged again. Please contact webmaster@swa.co.uk if there is a problem"]);
			die();
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
			echo json_encode($output);
		} catch (Error $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
			die();
		}

		jexit();
	}

	public function setMemberPaid()
	{
		$jinput = $this->input->json;
		$paymentIntentId = $jinput->get('paymentIntentId', "", 'string');
		$paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
		$model  = $this->getModel('MemberPayment');
		$member = $model->getMember();
		$member_id = $member->id;

		if (!($paymentIntent->status == 'succeeded')) {
			http_response_code(500);
			echo json_encode(['error' => "Payment failed. You should not have been charged. Please contact webmaster@swa.co.uk
			 for assistance and to confirm no payment has been taken. Do not try again."]);
			die();
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
			http_response_code(500);
			echo json_encode(['error' => 'Failed to record payment. Please contact webmaster@swa.co.uk ASAP to resolve this.']);
			die();
		}

		echo json_encode(['message' => 'Success!']);
		$this->logAuditFrontend("Member({$member_id}) bought their membership for Season({$seasonName})");
	}
}
