<?php
header("Content-Type:application/json");
require_once("../../lib/qiniu/rs.php");
require_once("../../qiniu_config.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$returnBody = array(
    "hash" => "$(hash)",
    "key" => "$(key)",
    "mimeType" => "$(mimeType)"
);
$returnBody = json_encode($returnBody);
$putPolicy->ReturnBody = $returnBody;
$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
