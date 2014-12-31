<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//delete接口删除文件
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/delete.html
$bucket = "if-pbl";
$key = "qiniu_vsample_000001";
$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
$err = Qiniu_RS_Delete($mclient, $bucket, $key);
QiniuLab_PrintResult(null, $err);