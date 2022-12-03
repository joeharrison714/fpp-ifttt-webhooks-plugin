<?php
include_once "/opt/fpp/www/config.php";
include_once "iftttw-common.php";

$payloads = getPayloadOptions();

logEntry( json_encode($payloads));

$arr = [];
foreach($payloads as $item) {
    $name = $item['name'];
    $arr[] = $name;
}

logEntry( json_encode($arr));


header('Content-type: application/json');
echo json_encode($arr);

?>