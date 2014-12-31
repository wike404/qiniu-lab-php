<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("print_result.php");

//使用SaveKey保存上传文件名
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->SaveKey = "qiniu_storage_logo.png";
$auth = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$upToken = $putPolicy->Token($auth);
$localFile = "/Users/jemy/Documents/qiniu.png";
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
list($ret, $err) = Qiniu_PutFile($upToken, null, $localFile, $putExtra);
QiniuLab_PrintUploadResult($ret, $err);

//使用扩展参数来构成SaveKey
$putPolicy->SaveKey = "$(x:exParam1)_$(x:exParam2)_$(x:exParam3)_$(etag)";
$upToken = $putPolicy->Token($auth);
list($ret, $err) = Qiniu_PutFile($upToken, null, $localFile, $putExtra);
QiniuLab_PrintUploadResult($ret, $err);