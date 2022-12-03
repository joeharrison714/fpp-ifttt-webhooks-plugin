<?php
include_once "/opt/fpp/www/common.php"; //Alows use of FPP Functions
include_once "iftttw-common.php";


if (strlen(urldecode($pluginSettings['ifttt_key']))<1){
	WriteSettingToFile("ifttt_key",urlencode(""),$pluginName);
}

$iftttKey = urldecode($pluginSettings['ifttt_key']);

$isConfigured = false;
if (strlen($pluginSettings['ifttt_key']) > 0)
{
	$isConfigured = true;
}

?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div class="pluginBody" style="margin-left: 1em;">
	<div class="title">
		<h1>IFTTT Webhooks Settings</h1>
		<h4></h4>
	</div>

	<p>Press F1 for setup instructions</p>

<table cellspacing="5">


<tr>
	<th style="text-align: left">IFTTT Webhook Key</th>
<td>
<?
//function PrintSettingTextSaved($setting, $restart = 1, $reboot = 0, $maxlength = 32, $size = 32, $pluginName = "", $defaultValue = "", $callbackName = "", $changedFunction = "", $inputType = "text", $sData = Array())
	PrintSettingTextSaved("ifttt_key", $restart = 0, $reboot = 0, $maxlength = 50, $size = 50, $pluginName = $pluginName, $defaultValue = "");
?>
</td>
</tr>

</table>


<?

if ($isConfigured){
?>
<!--p style="font-size: 16pt; font-weight: bold;">SmartThings commands should now be available throughout FPP. If they are not, try restarting FPPD.</p-->
<h3>Test</h3>
<?
}
?>


</body>
</html>