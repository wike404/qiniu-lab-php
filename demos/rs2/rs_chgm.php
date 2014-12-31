<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/conf.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//chgm接口用来手动设置资源的mimeType
//文档：http://developer.qiniu.com/docs/v6/api/reference/rs/chgm.html
$bucket = "if-pbl";
$key = "baidu_logo.png";
$mimeType = "image/jpg";

$fetchUri = $QINIU_RS_HOST . "/chgm/" . Qiniu_Encode($bucket . ":" . $key) . "/mime/" . Qiniu_Encode($mimeType);

$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
$err = Qiniu_Client_CallNoRet($mclient, $fetchUri);
QiniuLab_PrintResult(null, $err);