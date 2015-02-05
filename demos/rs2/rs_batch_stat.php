<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/auth_digest.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//batch stat接口批量查看文件信息
//文档：
//http://developer.qiniu.com/docs/v6/api/reference/rs/batch.html
//http://developer.qiniu.com/docs/v6/api/reference/rs/stat.html
$op1 = Qiniu_RS_URIStat("if-pbl", "qiniu.jpg");
$op2 = Qiniu_RS_URIStat("if-pbl", "baidu_logo.png");
$op3 = Qiniu_RS_URIStat("if-pbl", "qiniu_wm_text_and_img.mp4");
$op4 = Qiniu_RS_URIStat("qdisk", "qiniu.jpg");
$op5 = Qiniu_RS_URIStat("qdisk", "jemy.png");
$ops = array($op1, $op2, $op3, $op4, $op5);
$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$mclient = new Qiniu_MacHttpClient($mac);
list($ret, $err) = Qiniu_RS_Batch($mclient, $ops);
QiniuLab_PrintBatchStatResult($ret, $err);