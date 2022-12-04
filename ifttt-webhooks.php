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
	PrintSettingTextSaved("ifttt_key", $restart = 0, $reboot = 0, $maxlength = 50, $size = 50, $pluginName = $pluginName, $defaultValue = "", $changedFunction = "keyChanged");
?>
</td>
</tr>

</table>

<br />
<br />
<hr />

<?

if ($isConfigured){
?>
<p style="font-size: 16pt; font-weight: bold;">IFTTT Webhook Trigger command should now be available throughout FPP. If it is not, try restarting FPPD.</p>
<h3>Test</h3>

<div>
<table cellspacing="5">


<tbody>
    <tr>
	<th style="text-align: left">Event Name</th>
<td>
<input type="text" id="test_event_name" maxlength="50" size="50" value="lead_in">
</td>
</tr>

<tr>
	<th style="text-align: left">Payload</th>
<td>
<select id="test_event_payload">
	<?
		$payloads = getPayloadOptions();
		foreach($payloads as $item) {
			$name = $item['name'];
			echo '<option value="' . $name . '">' . $name . '</option>';
		}
	?>
</select>
</td>
</tr>

<tr>
    <td>
        <button onclick="testButton();">Send Test Event</button>
    </td>
</tr>

</tbody></table>
</div>

<?
}
?>

<script type="text/javascript">
function keyChanged(){
	location.reload(true);
}
function testButton(){
    ten = $('#test_event_name').val();
    tep = $('#test_event_payload').val();
    testExecute(ten, tep);
}
function testExecute(name, po){
	url = '/api/command/' + encodeURIComponent('IFTTT Webhook Trigger') + '/' + encodeURIComponent(name) + '/' + encodeURIComponent(po);
	$.get( url, function( data ) {
		// no op
	});
}
</script>


</body>
</html>