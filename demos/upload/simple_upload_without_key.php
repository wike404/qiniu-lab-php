<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

//无key文件上传
$upToken = $putPolicy->Token(null);
$localFile = "/Users/jemy/Documents/qiniu.jpg";
list($ret, $err) = Qiniu_PutFile($upToken, null, $localFile, null);
QiniuLab_PrintResult($ret, $err);

//无Key数据上传
$upToken = $putPolicy->Token(null);
$localData = "hello world, 七牛云存储";
list($ret, $err) = Qiniu_Put($upToken, null, $localData, null);
QiniuLab_PrintResult($ret, $err);

//手动设置mimeType
$upToken = $putPolicy->Token(null);
$localData = "hello qiniu, 七牛云存储";
$putExtra = new Qiniu_PutExtra();
$putExtra->MimeType = "text/plain";
list($ret, $err) = Qiniu_Put($upToken, null, $localData, $putExtra);
QiniuLab_PrintResult($ret, $err);

//带Crc32检测
$upToken = $putPolicy->Token(null);
$localData = "qiniu cloud, 七牛云存储";
$putExtra = new Qiniu_PutExtra();
$putExtra->MimeType = "text/plain";
$putExtra->CheckCrc = TRUE;
$putExtra->Crc32 = crc32($localData);
list($ret, $err) = Qiniu_Put($upToken, null, $localData, $putExtra);
QiniuLab_PrintResult($ret, $err);

//带扩展参数
$upToken = $putPolicy->Token(null);
$localData = "qiniu cloud storage, 七牛云存储";
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
list($ret, $err) = Qiniu_Put($upToken, null, $localData, $putExtra);
QiniuLab_PrintResult($ret, $err);