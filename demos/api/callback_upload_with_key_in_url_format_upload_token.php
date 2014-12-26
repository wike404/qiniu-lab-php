<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->CallbackUrl = $APP_CALLBACK_ROOT . "/demos/service/callback_upload_service.php";
$callbackBody = "fname=$(fname)&etag=$(etag)&key=$(key)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
//your own server will get the callbackbody posted by qiniu server with a content-type of application/x-www-form-urlencoded
$putPolicy->CallbackBody = $callbackBody;
$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;