<?php
header("Content-Type:application/json");
require_once("../../lib/qiniu/rs.php");
require_once("../../qiniu_config.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

#only images can be uploaded
$imageOnlyLimit = "image/*";

#only allow jpeg and png file
$imageJpegAndPngLimit = "image/jpeg;image/png";

#all files except for json and text
$imageNoneJsonOrText = "!application/json;text/plain";

#select an option you want to set
$mimeLimit = $imageJpegAndPngLimit;

$putPolicy->MimeLimit = $mimeLimit;

$token = $putPolicy->Token(null);
$respData = array(
    "mimeLimit" => $mimeLimit,
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
