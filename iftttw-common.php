<?php
include_once "/opt/fpp/www/config.php";

$pluginName = basename(dirname(__FILE__));
$pluginPath = $settings['pluginDirectory']."/".$pluginName."/"; 

$logFile = $settings['logDirectory']."/".$pluginName."-execute.log";

$pluginConfigFile = $settings['configDirectory'] . "/plugin." .$pluginName;

if (file_exists($pluginConfigFile)) {
	$pluginSettings = parse_ini_file($pluginConfigFile);
}

function getPayloadOptions(){
    $payloadArr = array (
        array(
            "name" => "None",
            "id" => "0"
        ),
        array(
            "name" => "FPPD Status",
            "id" => "1"
        ),
        array(
            "name" => "System Status",
            "id" => "2"
        )
    );
    return $payloadArr;
}

function logEntry($data) {

	global $logFile,$myPid;

	$data = $_SERVER['PHP_SELF']." : [".$myPid."] ".$data;
	
	$logWrite= fopen($logFile, "a") or die("Unable to open file!");
	fwrite($logWrite, date('Y-m-d h:i:s A',time()).": ".$data."\n");
	fclose($logWrite);
}

?>