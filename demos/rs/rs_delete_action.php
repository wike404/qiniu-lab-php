<?php
require_once ("../../lib/qiniu/conf.php");
require_once ("../../lib/qiniu/rs.php");
require_once ("../../lib/qiniu/http.php");
require_once ("../../lib/qiniu/auth_digest.php");
require_once ("../../qiniu_config.php");
header("Content-Type: application/json");
if (!isset($_POST["bucket"]) || !isset($_POST["key"])) {
	$respBody = array("error" => "param bucket or key not set");
} else {
	$bucket = $_POST["bucket"];
	$key = $_POST["key"];
	if (empty($bucket)) {
		$respBody = array("error" => "bucket is not specified");
	} else if (empty($key)) {
		$respBody = array("error" => "key is not specified");
	} else {
		$deleteUrl = $QINIU_RS_HOST.Qiniu_RS_URIDelete($bucket, $key);
		$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
		$httpClient = new Qiniu_MacHttpClient($mac);
		$respBody = Qiniu_Client_Call($httpClient, $deleteUrl);
	}
}
$respBody = json_encode($respBody);
echo $respBody;
