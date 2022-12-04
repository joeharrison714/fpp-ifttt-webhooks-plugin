#!/usr/bin/env php
<?php
include_once "/opt/fpp/www/config.php";
include_once "/home/fpp/media/plugins/fpp-ifttt-webhooks/iftttw-common.php";

$eventName = $argv[1];
$payload = $argv[2];
logEntry( "Event Name: " . $eventName . "  Payload: " . $payload);

if (strlen($eventName) == 0){
	throw new Exception('No event specified.');
}

if (strlen($payload) == 0){
	throw new Exception('No payload specified.');
}

// if (strlen($name) == 0){
// 	throw new Exception('No name specified.');
// }

?>