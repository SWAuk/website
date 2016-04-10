<?php
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

class SwaModelSeasonResults extends SwaModelList {

    private $seasonId = 15;

    /**
     * @todo team series?
     * @todo university series?
     * @return array
     */
    public function getItems() {
        // Get the data from the DB
        $indiSeriesDetails = array_merge( $this->getMainSeriesDetails(), $this->getSexSeriesDetails() );

        // Split the individual results up into maps of (series => name => result details)
        foreach ( $this->getIndividualResults() as $individualResult ) {
            $indiSeriesDetails[$individualResult['series']]['results'][$individualResult['name']] = $individualResult;
            $indiSeriesDetails[$individualResult['sex']]['results'][$individualResult['name']] = $individualResult;
        }

        // Add DNC scores for people that missed competitions
        foreach ( $indiSeriesDetails as $seriesName => &$seriesDetails ) {
            $dncScore = $seriesDetails['dnc_score'];
            $competitions = $seriesDetails['competitions'];
            foreach ( $seriesDetails['results'] as &$result ) {
                $competitionsMissed = $competitions - $result['competitions'];
                $result['dnc_count'] = $competitionsMissed;
                if ( $competitionsMissed >= 1 ) {
                    $result['result'] += ( $competitionsMissed * $dncScore );
                }
            }
        }

        // Sort the results of each series (lowest score first)
        foreach ( $indiSeriesDetails as $seriesName => &$seriesDetails ) {
            uasort( $seriesDetails['results'], function( $a, $b ) {
                // A smaller result score is better
                if ( $a['result'] != $b['result'] ) {
                    return $a['result'] > $b['result'];
                }
                // A smaller dnc_count is better
                if( $a['dnc_count'] != $b['dnc_count'] ) {
                    return $a['dnc_count'] > $b['dnc_count'];
                }
                // They are equal!
                return 0;
            } );
        }

        return $indiSeriesDetails;
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
    private function getMainSeriesDetails() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );
        $query->setQuery(
            "SELECT
	comp_type.series as series,
	COUNT( DISTINCT event.id ) as events,
	COUNT( DISTINCT event.id, comp_type.series ) as competitions,
	COUNT( DISTINCT indi_result.member_id ) as entrants,
	COUNT( DISTINCT indi_result.member_id ) + 2 as dnc_score
FROM jwhitwor_swaj.swan_swa_season as season
LEFT JOIN swan_swa_event as event
ON season.id = event.season_id
LEFT JOIN swan_swa_competition as comp
ON event.id = comp.event_id
LEFT JOIN swan_swa_competition_type as comp_type
ON comp.competition_type_id = comp_type.id
LEFT JOIN swan_swa_indi_result as indi_result
ON indi_result.competition_id = comp.id
WHERE season.id = {$this->seasonId}
AND comp_type.name IS NOT NULL
AND comp_type.name != 'Team'
GROUP BY comp_type.series;"
        );

        $db->setQuery( $query );
        return $db->loadAssocList( 'series' );
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
    private function getSexSeriesDetails() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );
        $query->setQuery(
            "SELECT
	LCASE( member.sex ) as series,
	COUNT( DISTINCT event.id ) as events,
	COUNT( DISTINCT event.id, comp_type.series ) as competitions,
	COUNT( DISTINCT indi_result.member_id ) as entrants,
	COUNT( DISTINCT indi_result.member_id ) + 2 as dnc_score
FROM jwhitwor_swaj.swan_swa_season as season
LEFT JOIN swan_swa_event as event
ON season.id = event.season_id
LEFT JOIN swan_swa_competition as comp
ON event.id = comp.event_id
LEFT JOIN swan_swa_competition_type as comp_type
ON comp.competition_type_id = comp_type.id
LEFT JOIN swan_swa_indi_result as indi_result
ON indi_result.competition_id = comp.id
LEFT JOIN swan_swa_member as member
ON indi_result.member_id = member.id
WHERE season.id = {$this->seasonId}
AND comp_type.name IS NOT NULL
AND comp_type.name != 'Team'
GROUP BY LCASE( member.sex );"
        );

        $db->setQuery( $query );
        return $db->loadAssocList( 'series' );
    }

    /**
     * @return array that looks like:
     *
     * array(
     *     array(
     *         'series' => 'Race',
     *         'member_id' => 4,
     *         'name' => 'Mark Smith',
     *         'result' => 20,
     *         'events' => 3,
     *     ),
     * )
     */
    private function getIndividualResults() {
        $db = $this->getDbo();
        $query = $db->getQuery( true );
        $query->setQuery(
            "SELECT
	comp_type.series as series,
	indi_result.member_id,
	user.name,
	LCASE( member.sex ) as sex,
	SUM( indi_result.result ) as result,
	COUNT( indi_result.result ) as events,
	COUNT( DISTINCT event.id, comp_type.series ) as competitions
FROM jwhitwor_swaj.swan_swa_season as season
LEFT JOIN swan_swa_event as event
ON season.id = event.season_id
LEFT JOIN swan_swa_competition as comp
ON event.id = comp.event_id
LEFT JOIN swan_swa_competition_type as comp_type
ON comp.competition_type_id = comp_type.id
LEFT JOIN swan_swa_indi_result as indi_result
ON indi_result.competition_id = comp.id
LEFT JOIN swan_swa_member as member
ON indi_result.member_id = member.id
LEFT JOIN swan_users as user
ON member.user_id = user.id
WHERE season.id = 15
AND comp_type.name IS NOT NULL
AND comp_type.name != 'Team'
GROUP BY comp_type.series, member.id;"
        );

        $db->setQuery( $query );
        return $db->loadAssocList();
    }

}
