<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/conf.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//fetch接口用来从网络上抓取资源并保存到空间中。
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/fetch.html
$srcUrl = "http://www.baidu.com/img/bdlogo.png";
$saveBucket = "if-pbl";
$saveKey = "baidu_logo.png";

$QINIU_IOVIP_HOST = 'http://iovip.qbox.me';
$fetchUri = $QINIU_IOVIP_HOST . "/fetch/" . Qiniu_Encode($srcUrl) . "/to/" . Qiniu_Encode($saveBucket . ":" . $saveKey);

$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
$err = Qiniu_Client_CallNoRet($mclient, $fetchUri);
QiniuLab_PrintResult(null, $err);