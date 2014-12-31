<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$auth = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);

//有key文件上传
$upToken = $putPolicy->Token($auth);
$localFile = "/Users/jemy/Documents/qiniu.png";
$key = "qiniu_20141231.png";
$putExtra = new Qiniu_PutExtra();
$putExtra->MimeType = "image/png";
$putExtra->CheckCrc = TRUE;
$putExtra->Crc32 = crc32(file_get_contents($localFile));
//扩展参数必须以x:开头，否则会被忽略
$params = array(
    "x:exParam1" => "hello",
    "x:exParam2" => "qiniu",
    "x:exParam3" => "cloud",
    "exParam4" => "storage",
);
$putExtra->Params = $params;
list($ret, $err) = Qiniu_PutFile($upToken, $key, $localFile, $putExtra);
QiniuLab_PrintResult($ret, $err);

//有Key数据上传
$upToken = $putPolicy->Token($auth);
$localData = "qiniu cloud storage, 七牛云存储";
$key = "qiniu_welcome_msg.txt";
$putExtra = new Qiniu_PutExtra();
$putExtra->MimeType = "text/plain";
$putExtra->CheckCrc = TRUE;
$putExtra->Crc32 = crc32($localData);
//扩展参数必须以x:开头，否则会被忽略
$params = array(
    "x:exParam1" => "hello",
    "x:exParam2" => "qiniu",
    "x:exParam3" => "cloud",
    "exParam4" => "storage",
);
$putExtra->Params = $params;
list($ret, $err) = Qiniu_Put($upToken, $key, $localData, $putExtra);
QiniuLab_PrintResult($ret, $err);