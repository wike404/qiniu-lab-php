<?php
require_once ("../../lib/qiniu/auth_digest.php");
require_once ("../../lib/qiniu/conf.php");
require_once ("../../lib/qiniu/utils.php");
require_once ("../../qiniu_config.php");
require_once ("../../lib/qiniu/http.php");
header("Content-Type: application/json");
//check params
if (!isset($_POST["bucket"])) {
	$respData = array("error" => "no bucket specified");
} elseif (!isset($_POST["key"])) {
	$respData = array("error" => "no key specified");
} elseif (!isset($_POST["fops"])) {
	$respData = array("error" => "no fops specifed");
} elseif (!isset($_POST["notifyURL"])) {
	$respData = array("error" => "no notifyURL specifed");
} else {
	$bucket = $_POST["bucket"];
	$key = $_POST["key"];
	$fops = $_POST["fops"];
	$notifyURL = $_POST["notifyURL"];
	$force = $_POST["force"];
	$pipeline = $_POST["pipeline"];

	//encode params
	$bucket = urlencode($bucket);
	$key = urlencode($key);
	$fops = urlencode($fops);
	$notifyURL = urlencode($notifyURL);
	//create request
	$requestURL = "http://api.qiniu.com/pfop";
	if (empty($pipeline)) {
		$requestBody = sprintf("bucket=%s&key=%s&fops=%s&notifyURL=%s&force=%d", $bucket, $key, $fops, $notifyURL, $force);
	} else {
		$requestBody = sprintf("bucket=%s&key=%s&fops=%s&notifyURL=%s&force=%d&pipeline=%s", $bucket, $key, $fops, $notifyURL, $force, $pipeline);
	}
	$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
	$client = new Qiniu_MacHttpClient($mac);
	$respData = Qiniu_Client_CallWithForm($client, $requestURL, $requestBody);
}
$respBody = json_encode($respData);
echo $respBody;
?>

