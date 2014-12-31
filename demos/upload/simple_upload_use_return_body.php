<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//使用ReturnBody自定义返回内容
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
//以json格式组织回复内容，支持魔法变量和扩展变量。
//文档：http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html
$returnBody = array(
    "bucket" => "$(bucket)",
    "fsize" => "$(fsize)",
    "fname" => "$(fname)",
    "etag" => "$(etag)",
    "key" => "$(key)",
    "exParam1" => "$(x:exParam1)",
    "exParam2" => "$(x:exParam2)",
    "exParam3" => "$(x:exParam3)",
    "exParam4" => "$(exParam4)", //这个扩展参数没有以x:开头，会被忽略
);
$putPolicy->ReturnBody = json_encode($returnBody);
$auth = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$upToken = $putPolicy->Token($auth);
$key = "hello_qiniu_logo_20141231.png";
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
list($ret, $err) = Qiniu_PutFile($upToken, $key, $localFile, $putExtra);
QiniuLab_PrintResult($ret, $err);