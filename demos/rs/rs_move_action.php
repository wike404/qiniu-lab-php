<?php
header("Content-Type: application/json");
require_once ("../../lib/qiniu/conf.php");
require_once ("../../lib/qiniu/rs.php");
require_once ("../../lib/qiniu/http.php");
require_once ("../../lib/qiniu/auth_digest.php");
require_once ("../../qiniu_config.php");
if (!isset($_POST["srcBucket"]) || empty($_POST["srcBucket"])) {
	$respBody = array("error" => "src bucket not specified");
} else if (!isset($_POST["srcKey"]) || empty($_POST["srcKey"])) {
	$respBody = array("error" => "src key not specified");
} else if (!isset($_POST["destBucket"]) || empty($_POST["destBucket"])) {
	$respBody = array("error" => "dest bucket not specified");
} else if (!isset($_POST["destKey"]) || empty($_POST["destKey"])) {
	$respBody = array("error" => "dest key not specified");
} else {
	$srcBucket = $_POST["srcBucket"];
	$srcKey = $_POST["srcKey"];
	$destBucket = $_POST["destBucket"];
	$destKey = $_POST["destKey"];
	$moveUrl = $QINIU_RS_HOST . Qiniu_RS_URIMove($srcBucket, $srcKey, $destBucket, $destKey);
	$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
	$httpClient = new Qiniu_MacHttpClient($mac);
	$respBody = Qiniu_Client_Call($httpClient, $moveUrl);
}
$respBody = json_encode($respBody);
echo $respBody;
