<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//move来移动或者重命名资源
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/move.html
$srcBucket = "if-pbl";
$srcKey = "qiniu.jpg";
$destBucket = "qiniulab-public";
$destKey = "qiniu.jpg";

$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
$err = Qiniu_RS_Move($mclient, $srcBucket, $srcKey, $destBucket, $destKey);
QiniuLab_PrintResult(null, $err);