<?php
$skipJSsettings=true;
include_once "/opt/fpp/www/config.php";

$pluginName = basename(dirname(__FILE__));
$pluginPath = $settings['pluginDirectory']."/".$pluginName."/";

// FPP rotates plugin-*.log files and shows them in its log viewer.
$logFile = $settings['logDirectory']."/plugin-".$pluginName.".log";

$pluginConfigFile = $settings['configDirectory'] . "/plugin." .$pluginName;

if (file_exists($pluginConfigFile)) {
	$pluginSettings = parse_ini_file($pluginConfigFile);
}
if (!isset($pluginSettings) || !is_array($pluginSettings)) {
	$pluginSettings = array();
}

function getPayloadOptions(){
    $payloadArr = array (
        array(
            "id" => "0",
            "name" => "None",
            "path" => ""
        ),
        array(
            "id" => "1",
            "name" => "FPPD Status",
            "path" => "/api/fppd/status"
        ),
        array(
            "id" => "2",
            "name" => "System Status",
            "path" => "/api/system/status"
        )
    );
    return $payloadArr;
}

function logEntry($data) {
	global $logFile;

	$line = date('Y-m-d h:i:s A') . ": " . basename($_SERVER['PHP_SELF']) . " : [" . getmypid() . "] " . $data . "\n";
	@file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
}

?>
