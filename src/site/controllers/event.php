<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

class SwaControllerEvent extends SwaController
{
	public function downloadAttendees()
	{
		/** @var SwaModelMemberDetails $model */
		$model  = $this->getModel('Event');
		$member = $model->getMember();
		$item   = $model->getItem();

		$hostUniversities = explode(',', $item->hosts);
		$isHostCommittee  = in_array($member->uni_id, $hostUniversities) && $member->club_committee;

		if ($member->swa_committee || $isHostCommittee)
		{
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=event_attendees.csv");
			header("Pragma: no-cache");
			header("Expires: 0");

			$data = $model->getEventAttendees();

			$csv = fopen("php://output", "w");
			fputcsv($csv, array_keys($data[0]));
			foreach ($data as $row)
			{
				fputcsv(
					$csv,
					$row
				);
			}

			fclose($csv);

			jexit();
		}
		else
		{
			die("Access denied!");
		}
	}
}
