<?php
include_once "/opt/fpp/www/config.php";
include_once "iftttw-common.php";

$payloads = getPayloadOptions();

$arr = [];
foreach($payloads as $item) {
    $name = $item->name;
    $arr[] = $name;
}

header('Content-type: application/json');
echo json_encode($arr);

?>