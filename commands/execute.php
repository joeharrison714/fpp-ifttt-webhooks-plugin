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

	$payloadUrl = "";
	
	foreach($payloads as $item) {
		$name = $item['name'];
		if ($name == $payload){
			$payloadUrl = $item['path'];
			break;
		}
	}

	$payloadData = "";
	if (strlen($payloadUrl) != 0){
		$payloadData = getPayload($payloadUrl);
	}

	logEntry( "Payload Data: " . $payloadData);

}
else{
	logEntry("Skipping executing due to plugin not being configured");
}

function getPayload($path) {
    $result=file_get_contents("http://127.0.0.1".$path);
    return json_decode( $result );
}

?>