#!/usr/bin/env php
<?php
include_once "/opt/fpp/www/config.php";
include_once "/home/fpp/media/plugins/fpp-ifttt-webhooks/iftttw-common.php";

$logFile2 = "/home/fpp/media/logs/debug-execute.log";
$data2 = "HELLO FROM EXECUTE";
$logWrite2= fopen($logFile2, "a") or die("Unable to open file!");
fwrite($logWrite2, date('Y-m-d h:i:s A',time()).": ".$data2."\n");
fclose($logWrite2);

$eventName = $argv[1];
$payload = $argv[2];
#logEntry( "Event Name: " . $eventName . "  Payload: " . $payload);

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