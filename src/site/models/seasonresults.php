<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SwaModelSeasonResults extends SwaModelList
{
	private $seasonId = 21;

	private $cachedMethodDbMap = array();

	/**
	 * @return array
	 */
	public function getIndividualItems()
	{
		// Get the series details from the DB
		$indiSeriesDetails     = $this->getMainSeriesDetails();
		$compTypeEntrantCounts = $this->getCompTypeEntrantCounts();
		$individualResults     = $this->getIndividualResults();

		// Add the offsets for different levels
		foreach ($individualResults as &$individualResult)
		{
			if ($individualResult['series'] == 'race')
			{
				$individualResult['offset'] = 0;
				switch ($individualResult['comp_type'])
				{
					case 'beginner race':
						$individualResult['result'] += $compTypeEntrantCounts['intermediate race']['entrants'];
						$individualResult['offset'] += $compTypeEntrantCounts['intermediate race']['entrants'];
					case 'intermediate race':
						$individualResult['result'] += $compTypeEntrantCounts['advanced race']['entrants'];
						$individualResult['offset'] += $compTypeEntrantCounts['advanced race']['entrants'];
						break;
				}
			}
		}

		// Split the individual results up into maps of (series => name => result details)
		foreach ($individualResults as $individualResult)
		{
			$indiSeriesDetails[$individualResult['series']]['results'][$individualResult['name']] = $individualResult;
		}

		// Add DNC scores for people that missed competitions
		foreach ($indiSeriesDetails as $seriesName => &$seriesDetails)
		{
			$dncScore     = $seriesDetails['dnc_score'];
			$competitions = $seriesDetails['competitions'];
			foreach ($seriesDetails['results'] as &$result)
			{
				$competitionsMissed   = $competitions - $result['competitions'];
				$result['dnc_count']  = $competitionsMissed;
				$result['dnc_points'] = ($competitionsMissed * $dncScore);
				if ($competitionsMissed >= 1)
				{
					$result['result'] += ($competitionsMissed * $dncScore);
				}
				$result['discards']       = 0;
				$result['discard_points'] = 0;
			}
		}

		// Remove a single freestyle discard if possible
		foreach ($indiSeriesDetails as $seriesName => &$seriesDetails)
		{
			foreach ($seriesDetails['results'] as &$result)
			{
				if ($result['series'] == 'freestyle')
				{
					if ($result['dnc_count'] > 0)
					{
						$discardValue = max(array($indiSeriesDetails['freestyle']['dnc_score'], $result['max_result']));
					}
					else
					{
						$discardValue = $result['max_result'];
					}
					$result['result'] -= $discardValue;
					$result['discards']++;
					$result['discard_points'] += $discardValue;
				}
			}
		}

		// Sort the results of each series (lowest score first)
		foreach ($indiSeriesDetails as $seriesName => &$seriesDetails)
		{
			uasort($seriesDetails['results'], function ($a, $b) {
				// A smaller result score is better
				if ($a['result'] != $b['result'])
				{
					return $a['result'] > $b['result'];
				}
				// A smaller dnc_count is better
				if ($a['dnc_count'] != $b['dnc_count'])
				{
					return $a['dnc_count'] > $b['dnc_count'];
				}

				// They are equal!
				return 0;
			});
		}

		return $indiSeriesDetails;

	}

	public function getGenderItems()
	{
		$genderSeriesDetails = $this->getGenderSeriesDetails();

		// Split the individual results up into maps of (series => name => result details)
		foreach ($this->getIndividualItems() as $seriesName => $seriesDetails)
		{
			foreach ($seriesDetails['results'] as $result)
			{
				$gender  = $result['gender'];
				$name = $result['name'];
				@$genderSeriesDetails[$gender]['results'][$name]['name'] = $name;
				@$genderSeriesDetails[$gender]['results'][$name]['university'] = $result['university'];
				@$genderSeriesDetails[$gender]['results'][$name]['series'] = $gender;
				@$genderSeriesDetails[$gender]['results'][$name]['gender'] = $gender;
				@$genderSeriesDetails[$gender]['results'][$name]['member_id'] = $result['member_id'];
				@$genderSeriesDetails[$gender]['results'][$name]['result'] += $result['result'];
				@$genderSeriesDetails[$gender]['results'][$name]['events'] += $result['events'];
				@$genderSeriesDetails[$gender]['results'][$name]['competitions'] += $result['competitions'];
				@$genderSeriesDetails[$gender]['results'][$name]['discards'] += $result['discards'];
				@$genderSeriesDetails[$gender]['results'][$name]['discard_points'] += $result['discard_points'];
				@$genderSeriesDetails[$gender]['results'][$name]['dnc_count'] += $result['dnc_count'];
				@$genderSeriesDetails[$gender]['results'][$name]['dnc_points'] += $result['dnc_points'];
			}
		}

		$indiSeriesDetails = $this->getIndividualItems();

		// Add extra DNC numbers for the gender series where people didn't enter any discipline in a series..
		// Also account for the freestyle discard
		foreach ($genderSeriesDetails as &$genderDetails)
		{
			foreach ($genderDetails['results'] as &$result)
			{
				foreach (array_keys($indiSeriesDetails) as $seriesName)
				{
					if (!array_key_exists($result['name'], $indiSeriesDetails[$seriesName]['results']))
					{
						$seriesDetails        = $indiSeriesDetails[$seriesName];
						$result['result']     += $seriesDetails['dnc_score'] * $seriesDetails['competitions'];
						$result['dnc_points'] += $seriesDetails['dnc_score'] * $seriesDetails['competitions'];
						$result['dnc_count']  += $seriesDetails['competitions'];
						if ($seriesName == 'freestyle')
						{
							$result['discards']++;
							$result['discard_points'] += $seriesDetails['dnc_score'];
							$result['result']         -= $seriesDetails['dnc_score'];
						}
					}
				}
			}
		}

		// Sort the results of each series (lowest score first)
		foreach ($genderSeriesDetails as $seriesName => &$seriesDetails)
		{
			uasort($seriesDetails['results'], function ($a, $b) {
				// A smaller result score is better
				if ($a['result'] != $b['result'])
				{
					return $a['result'] > $b['result'];
				}
				// A smaller dnc_count is better
				if ($a['dnc_count'] != $b['dnc_count'])
				{
					return $a['dnc_count'] > $b['dnc_count'];
				}

				// They are equal!
				return 0;
			});
		}

		return $genderSeriesDetails;
	}

	/**
	 * @return array that looks like:
	 *
	 * array(
	 *     'Division Name' => array(
	 *         'series' => 'Division Name',
	 *         'events' => 4,
	 *         'competitions' => 7,
	 *         'entrants' => 20,
	 *         'dnc_score' => 22,
	 *     ),
	 * )
	 */
	private function getMainSeriesDetails()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			LCASE( comp_type.series ) as series,
			COUNT( DISTINCT event.id ) as events,
			COUNT( DISTINCT event.id, comp_type.series ) as competitions,
			COUNT( DISTINCT indi_result.member_id ) as entrants,
			COUNT( DISTINCT indi_result.member_id ) + 2 as dnc_score
			FROM {$dbname}.{$prefix}swa_season as season
			JOIN {$prefix}swa_event as event
			ON season.id = event.season_id
			JOIN {$prefix}swa_competition as comp
			ON event.id = comp.event_id
			JOIN {$prefix}swa_competition_type as comp_type
			ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_indi_result as indi_result
			ON indi_result.competition_id = comp.id
			WHERE season.id = {$this->seasonId}
			AND comp_type.name != 'Team'
			GROUP BY comp_type.series;"
		);

		$db->setQuery($query);
		$this->cachedMethodDbMap[__METHOD__] = $db->loadAssocList('series');

		return $this->cachedMethodDbMap[__METHOD__];
	}

	/**
	 * @return array that looks like:
	 *
	 * array(
	 *     'Division Name' => array(
	 *         'Series' => 'Division Name',
	 *         'events' => 4,
	 *         'competitions' => 7,
	 *         'entrants' => 20,
	 *         'dnc_score' => 22,
	 *     ),
	 * )
	 */
	private function getGenderSeriesDetails()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			LCASE( member.race ) as series,
			COUNT( DISTINCT event.id ) as events,
			COUNT( DISTINCT event.id, comp_type.series ) as competitions,
			COUNT( DISTINCT indi_result.member_id ) as entrants,
			COUNT( DISTINCT indi_result.member_id ) + 2 as dnc_score
			FROM {$dbname}.{$prefix}swa_season as season
			JOIN {$prefix}swa_event as event
			ON season.id = event.season_id
			JOIN {$prefix}swa_competition as comp
			ON event.id = comp.event_id
			JOIN {$prefix}swa_competition_type as comp_type
			ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_indi_result as indi_result
			ON indi_result.competition_id = comp.id
			JOIN {$prefix}swa_member as member
			ON indi_result.member_id = member.id
			WHERE season.id = {$this->seasonId}
			AND comp_type.name != 'Team'
			GROUP BY LCASE( member.race );"
		);

		$db->setQuery($query);
		$this->cachedMethodDbMap[__METHOD__] = $db->loadAssocList('series');

		return $this->cachedMethodDbMap[__METHOD__];
	}

	/**
	 * @return array that looks like:
	 *
	 * array(
	 *     array(
	 *         'series' => 'race',
	 *         'series' => 'intermediate race',
	 *         'member_id' => 4,
	 *         'name' => 'Mark Smith',
	 *         'race' => 'male',
	 *         'result' => 20,
	 *         'max_result' => 143,
	 *         'events' => 3,
	 *         'competitions' => 3,
	 *     ),
	 * )
	 */
	private function getIndividualResults()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			LCASE( comp_type.series ) as series,
			LCASE( comp_type.name ) as comp_type,
			indi_result.member_id,
			user.name,
			university.name as university,
			LCASE( member.race ) as gender,
			SUM( indi_result.result ) - SUM( IF(indi_result.result = 1, 1, 0) ) * 0.5 as result,
			MAX( indi_result.result ) as max_result,
			COUNT( indi_result.result ) as events,
			COUNT( DISTINCT event.id, comp_type.series ) as competitions
			FROM {$dbname}.{$prefix}swa_season as season
			JOIN {$prefix}swa_event as event
			ON season.id = event.season_id
			JOIN {$prefix}swa_competition as comp
			ON event.id = comp.event_id
			JOIN {$prefix}swa_competition_type as comp_type
			ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_indi_result as indi_result
			ON indi_result.competition_id = comp.id
			JOIN {$prefix}swa_member as member
			ON indi_result.member_id = member.id
			JOIN {$prefix}swa_university as university
			ON member.university_id = university.id
			JOIN {$prefix}users as user
			ON member.user_id = user.id
			WHERE season.id = {$this->seasonId}
			AND comp_type.name != 'Team'
			GROUP BY comp_type.name, member.id;"
		);

		$db->setQuery($query);
		$this->cachedMethodDbMap[__METHOD__] = $db->loadAssocList();

		return $this->cachedMethodDbMap[__METHOD__];
	}

	private function getCompTypeEntrantCounts()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			comp_type.id as comp_type_id,
			LCASE( comp_type.name ) as comp_type,
			COUNT(*) as entrants
			FROM {$prefix}swa_indi_result as result
			JOIN {$prefix}swa_competition as comp ON result.competition_id = comp.id
			JOIN {$prefix}swa_competition_type as comp_type ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_event as event ON comp.event_id = event.id
			WHERE event.season_id = {$this->seasonId}
			AND LCASE( comp_type.series ) = 'race'
			GROUP BY comp_type.id;"
		);

		$db->setQuery($query);
		$this->cachedMethodDbMap[__METHOD__] = $db->loadAssocList('comp_type');

		return $this->cachedMethodDbMap[__METHOD__];
	}

	public function getTeamItems()
	{
		// Create a map of the results per event per uni
		$eventUniResultMap = array();
		foreach ($this->getTeamResults() as $result)
		{
			$eventUniResultMap[$result['event_id']][$result['name']][] = $result['result'];
		}

		$items = array();

		foreach ($eventUniResultMap as $eventId => &$eventUnis)
		{
			foreach ($eventUnis as $uniName => &$results)
			{
				/**
				 * Sort this universities teams results at this one event,
				 * we can then assume the first score is the best!
				 * Then use the key in the array to reassign a new team number.
				 * This means the best scores always go to team 1!
				 */
				sort($results, SORT_NUMERIC);
				foreach ($results as $key => $result)
				{
					// $key is 0 index, so add 1 so it makes sense
					$teamNumber                                  = $key + 1;
					$items[$uniName . '-' . $teamNumber]['name'] = $uniName;
					$items[$uniName . '-' . $teamNumber]['team'] = $teamNumber;
					// Also count the number of competitions for the team and add up the final result.
					@$items[$uniName . '-' . $teamNumber]['competitions']++;
					@$items[$uniName . '-' . $teamNumber]['result'] += $result;
					// Also keep track of the highest score of the team
					if (
						!array_key_exists('max_result', $items[$uniName . '-' . $teamNumber])
						|| $result > $items[$uniName . '-' . $teamNumber]['max_result']
					)
					{
						$items[$uniName . '-' . $teamNumber]['max_result'] = $result;
					}
				}
			}
		}

		$details = $this->getTeamSeriesDetails();

		// Add DNCs
		foreach ($items as $uniNameTeamNumberCombo => $teamDetails)
		{
			$missedEvents                                = $details['competitions'] - $teamDetails['competitions'];
			$items[$uniNameTeamNumberCombo]['dnc_count'] = $missedEvents;
			if ($missedEvents >= 1)
			{
				$items[$uniNameTeamNumberCombo]['result'] += ($details['dnc_score'] * $missedEvents);
			}
		}

		// Remove 1 discard per team!
		foreach ($items as $uniNameTeamNumberCombo => $teamDetails)
		{
			if ($teamDetails['dnc_count'] > 0)
			{
				$discardValue = max(array($details['dnc_score'], $teamDetails['max_result']));
			}
			else
			{
				$discardValue = $teamDetails['max_result'];
			}
			$items[$uniNameTeamNumberCombo]['result']         -= $discardValue;
			$items[$uniNameTeamNumberCombo]['discards']       = 1;
			$items[$uniNameTeamNumberCombo]['discard_points'] = $discardValue;
		}

		// Sort the results
		usort($items, function ($a, $b) {
			if ($a['result'] < $b['result'])
			{
				return false;
			}

			return true;
		});

		$details['results'] = $items;

		return $details;
	}


	/**
	 * @return array that looks like:
	 *
	 * array(
	 *     'competitions' => 4,
	 *     'universities' => 10,
	 *     'teams' => 13,
	 *     'dnc_score' => 15
	 * )
	 */
	private function getTeamSeriesDetails()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			COUNT( DISTINCT event.id, comp_type.series ) as competitions,
			COUNT( DISTINCT team_result.university_id ) as universities,
			COUNT( DISTINCT team_result.university_id, team_result.team_number ) as teams,
			COUNT( DISTINCT team_result.university_id, team_result.team_number ) + 2 as dnc_score
			FROM {$dbname}.{$prefix}swa_season as season
			JOIN {$prefix}swa_event as event
			ON season.id = event.season_id
			JOIN {$prefix}swa_competition as comp
			ON event.id = comp.event_id
			JOIN {$prefix}swa_competition_type as comp_type
			ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_team_result as team_result
			ON team_result.competition_id = comp.id
			WHERE season.id = {$this->seasonId}
			AND comp_type.name = 'Team';"
		);

		$db->setQuery($query);
		$list                                = $db->loadAssocList();
		$this->cachedMethodDbMap[__METHOD__] = array_shift($list);

		return $this->cachedMethodDbMap[__METHOD__];
	}


	/**
	 * @return array that looks like:
	 *
	 * array(
	 *     array(
	 *         'university_id' => 13,
	 *         'name' => 'UWE',
	 *         'team_number' => 1,
	 *         'event_id' => 165,
	 *         'result' => 3,
	 *     ),
	 * )
	 */
	private function getTeamResults()
	{
		if (isset($this->cachedMethodDbMap[__METHOD__]))
		{
			return $this->cachedMethodDbMap[__METHOD__];
		}
		$app    = JFactory::getApplication();
		$prefix = $app->get('dbprefix');
		$dbname = $app->get('db');
		$db     = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->setQuery(
			"SELECT
			team_result.university_id,
			university.name,
			team_result.team_number,
			event.id as event_id,
			IF( team_result.result = 1, 0.5, team_result.result ) as result
			FROM {$dbname}.{$prefix}swa_season as season
			JOIN {$prefix}swa_event as event
			ON season.id = event.season_id
			JOIN {$prefix}swa_competition as comp
			ON event.id = comp.event_id
			JOIN {$prefix}swa_competition_type as comp_type
			ON comp.competition_type_id = comp_type.id
			JOIN {$prefix}swa_team_result as team_result
			ON team_result.competition_id = comp.id
			JOIN {$prefix}swa_university as university
			ON team_result.university_id = university.id
			WHERE season.id = {$this->seasonId}
			AND comp_type.name = 'Team';"
		);

		$db->setQuery($query);
		$this->cachedMethodDbMap[__METHOD__] = $db->loadAssocList();

		return $this->cachedMethodDbMap[__METHOD__];
	}

}
