<?php
require_once ("../../lib/qiniu/http.php");
header("Content-Type: application/json");
if (!isset($_POST["persistentId"])) {
	$respBody = array("error" => "persistent id not specified");
} else {
	$persistentId = $_POST["persistentId"];
	$requestUrl = sprintf("http://api.qiniu.com/status/get/prefop?id=%s", $persistentId);
	$httpClient = new Qiniu_HttpClient($mac);
	$respBody = Qiniu_Client_Call($httpClient, $requestUrl);
}
$respBody = json_encode($respBody);
echo $respBody;
