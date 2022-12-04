#!/usr/bin/env php
<?php
$skipJSsettings=true;
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

$iftttKey = urldecode($pluginSettings['ifttt_key']);

$isConfigured = false;
if (strlen($pluginSettings['ifttt_key']) > 0)
{
	$isConfigured = true;
}

if ($isConfigured){
	$payloads = getPayloadOptions();
	
}
else{
	logEntry("Skipping executing due to plugin not being configured");
}

?>