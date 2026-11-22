<?php
include_once "/opt/fpp/www/common.php"; //Alows use of FPP Functions
include_once "iftttw-common.php";

$iftttKey = urldecode(isset($pluginSettings['ifttt_key']) ? $pluginSettings['ifttt_key'] : "");

if (strlen($iftttKey) < 1){
	WriteSettingToFile("ifttt_key",urlencode(""),$pluginName);
}

$isConfigured = strlen($iftttKey) > 0;

?>
<div class="pluginBody">
	<h2>IFTTT Webhooks Settings</h2>

	<p>Press F1 for setup instructions</p>

	<div class="row g-2 align-items-center mb-3">
		<div class="col-12 col-md-3"><label class="fw-bold" for="ifttt_key">IFTTT Webhook Key</label></div>
		<div class="col-12 col-md-9">
<?
//function PrintSettingTextSaved($setting, $restart = 1, $reboot = 0, $maxlength = 32, $size = 32, $pluginName = "", $defaultValue = "", $callbackName = "", $changedFunction = "", $inputType = "text", $sData = Array())
	PrintSettingTextSaved("ifttt_key", 0, 0, 50, 50, $pluginName, "", "keyChanged", "", "password");
?>
		</div>
	</div>

	<hr />

<?
if ($isConfigured){
?>
	<h3>Send Test Event</h3>

	<div class="row g-2 align-items-center mb-2">
		<div class="col-12 col-md-3"><label class="fw-bold" for="test_event_name">Event Name</label></div>
		<div class="col-12 col-md-9">
			<input type="text" class="form-control" style="max-width: 100%; width: 25rem;" id="test_event_name" maxlength="50" value="lead_in">
		</div>
	</div>

	<div class="row g-2 align-items-center mb-3">
		<div class="col-12 col-md-3"><label class="fw-bold" for="test_event_payload">Payload</label></div>
		<div class="col-12 col-md-9">
			<select class="form-select" style="max-width: 100%; width: 25rem;" id="test_event_payload">
<?
	$payloads = getPayloadOptions();
	foreach($payloads as $item) {
		$name = htmlspecialchars($item['name'], ENT_QUOTES);
		echo '<option value="' . $name . '">' . $name . '</option>';
	}
?>
			</select>
		</div>
	</div>

	<button type="button" class="buttons btn btn-success" onclick="testButton();">Send Test Event</button>
<?
}
?>
</div>

<script type="text/javascript">
function keyChanged(){
	location.reload(true);
}
function testButton(){
	var ten = $('#test_event_name').val();
	var tep = $('#test_event_payload').val();
	testExecute(ten, tep);
}
function testExecute(name, po){
	// POST /api/command/<name> with a JSON array of args works on FPP 5 and
	// later; the GET form is deprecated in 10.3 and removed in FPP 11.
	$.ajax({
		url: '/api/command/' + encodeURIComponent('IFTTT Webhook Trigger'),
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify([name, po])
	}).done(function () {
		$.jGrowl('Event sent. Check the plugin-<? echo $pluginName; ?>.log log for details.', { themeState: 'success' });
	}).fail(function () {
		$.jGrowl('Failed to run the IFTTT Webhook Trigger command.', { themeState: 'danger' });
	});
}
</script>
