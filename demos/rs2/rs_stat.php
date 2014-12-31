<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//stat接口查看文件信息
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/stat.html
$bucket = "if-pbl";
$key = "qiniu.jpg";
$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
list($ret, $err) = Qiniu_RS_Stat($mclient, $bucket, $key);
QiniuLab_PrintResult($ret, $err);