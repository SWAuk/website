<?php

// Settings
// Before migrating make sure your current IP can access both DBs
$to['host'] = 'localhost';
$to['db'] = 'j';
$to['user'] = 'root';
$to['pass'] = 'toor';
$toPrefix = 'i9nrq';
$from['host'] = 'host';
$from['db'] = 'db';
$from['user'] = 'user';
$from['pass'] = 'pass';
$fromPrefix = 'prefix';

// Over ride the above default settings using our hidden file
if(file_exists('migrate.cnf.php'))
	include 'migrate.cnf.php';

// Make the connections
echo "Connecting to databases\n";
$from = mysqli_connect( $from['host'], $from['user'], $from['pass'], $from['db'] );
$to = mysqli_connect( $to['host'], $to['user'], $to['pass'], $to['db'] );

//Loads all of the from tables
echo "Loading all data from all tables";
//$categories = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_categories');
//echo ".";
//$content = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_content');
//echo ".";
$users = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_users');
echo ".";
$swaUser = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_user');
echo ".";
$swaUnis = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_unis');
echo ".";
$swaTeamResults = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_team_results');
echo ".";
$swaSeasons = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_seasons');
echo ".";
$swaResults = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_results');
echo ".";
//$swaMail = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_mail');
//echo ".";
$swaEventGrants = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_event_grants');
echo ".";
$swaEventDeposits = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_event_deposits');
echo ".";
$swaEventDamages = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_event_damages');
echo ".";
$swaEventsUsers = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_events_users');
echo ".";
$swaEvents = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_events');
echo ".";
$swaEventLimits = mysqli_query( $from, "SELECT * FROM " . $fromPrefix . '_swa_event_limits');
echo "\nDone\n";

// Migrate the data..
// TODO

// Close the connections
echo "Closing database connections\n";
mysqli_close( $from );
mysqli_close( $to );