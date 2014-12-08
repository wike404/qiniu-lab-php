<?php
header("Content-Type:application/json");
require_once("../../lib/qiniu/rs.php");
require_once("../../qiniu_config.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

$videoLimi
$putPolicy->FsizeLimit=$fsizeLimit;

$token = $putPolicy->Token(null);
$respData = array(
    "fsizeLimit" => $fsizeLimit,
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
