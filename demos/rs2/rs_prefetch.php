<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/conf.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//prefetch接口更新镜像空间中的资源。
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/prefetch.html
$srcUrl = "http://www.baidu.com/img/bdlogo.png";

$QINIU_IOVIP_HOST = 'http://iovip.qbox.me';
$fetchUri = $QINIU_IOVIP_HOST . "/prefetch/" . Qiniu_Encode($srcUrl);

$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
$err = Qiniu_Client_CallNoRet($mclient, $fetchUri);
QiniuLab_PrintResult(null, $err);