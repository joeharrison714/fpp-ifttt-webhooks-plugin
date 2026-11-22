#!/usr/bin/env php
<?php
$skipJSsettings=true;
include_once "/opt/fpp/www/config.php";
include_once __DIR__ . "/../iftttw-common.php";

$eventName = isset($argv[1]) ? $argv[1] : "";
$payload = isset($argv[2]) ? $argv[2] : "";

logEntry( "Event Name: " . $eventName . "  Payload: " . $payload);

if (strlen($eventName) == 0){
	logEntry("No event specified, nothing sent.");
	exit(1);
}

if (strlen($payload) == 0){
	logEntry("No payload specified, nothing sent.");
	exit(1);
}

$iftttKey = urldecode(isset($pluginSettings['ifttt_key']) ? $pluginSettings['ifttt_key'] : "");

if (strlen($iftttKey) > 0){
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

	logEntry( "Payload Data Length: " . strlen($payloadData));

	callEndpoint($eventName, $iftttKey, $payloadData);
}
else{
	logEntry("Skipping executing due to plugin not being configured");
}

function callEndpoint($event, $iftttKey, $payloadData){
	// The key is part of IFTTT's URL, so the URL itself is never logged.
	$url = "https://maker.ifttt.com/trigger/" . rawurlencode($event) . "/json/with/key/" . rawurlencode($iftttKey);
	logEntry( "Sending event '" . $event . "' to maker.ifttt.com");

	// fppd waits for this script to exit before the command completes, so
	// don't let a slow or unreachable IFTTT hold it up for long.
	$options = array(
		'http' => array(
			'method'        => 'GET',
			'timeout'       => 10,
			'ignore_errors' => true
		)
	);

	if (strlen($payloadData) != 0){
		$options['http']['method'] = 'POST';
		$options['http']['content'] = $payloadData;
		$options['http']['header'] = "Content-Type: application/json\r\n";
	}

	$context = stream_context_create( $options );
	$result = @file_get_contents( $url, false, $context );

	if ($result === false || !isset($http_response_header) || count($http_response_header) == 0){
		$err = error_get_last();
		logEntry( "Webhook request failed: " . ($err ? $err['message'] : "no response"));
		return;
	}

	logEntry( "Webhook Response Code: " . $http_response_header[0]);
	logEntry( "Webhook Response: " . $result);
}

function getPayload($path) {
	$context = stream_context_create(array('http' => array('timeout' => 5)));
	$result = @file_get_contents("http://127.0.0.1" . $path, false, $context);
	if ($result === false){
		logEntry("Could not read payload from " . $path . ", sending without payload");
		return "";
	}
	return $result;
}

?>
