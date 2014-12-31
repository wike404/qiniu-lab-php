<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("../utils/print_result.php");

//带视频处理的文件上传
//文档：http://developer.qiniu.com/docs/v6/api/reference/fop/av/avthumb.html
$auth = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

//加水印，转码
$watermarkAndConvertFopSaveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_wm_text_and_img.mp4");
$wmText = "七牛云存储";
$wmImage = "http://qdisk.qiniudn.com/jemy.png";
$watermarkAndConvertFop = "avthumb/mp4/"
    . "wmText/" . Qiniu_Encode($wmText) . "/wmGravityText/NorthWest/"
    . "wmImage/" . Qiniu_Encode($wmImage) . "/wmGravity/NorthEast"
    . "|saveas/" . $watermarkAndConvertFopSaveas;

//加水印，转码并生成m3u8切片
$watermarkAndM3u8FopSaveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_wm_text_and_img.m3u8");
$watermarkAndM3u8Fop = "avthumb/m3u8/"
    . "wmText/" . Qiniu_Encode($wmText) . "/wmGravityText/NorthWest/"
    . "wmImage/" . Qiniu_Encode($wmImage) . "/wmGravity/NorthEast"
    . "|saveas/" . $watermarkAndM3u8FopSaveas;

//取第一帧
$vframeFopSaveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_vframe_1.png");
$vframeFop = "vframe/png/offset/0/w/400/h/300/rotate/auto|saveas/" . $vframeFopSaveas;

//取抽样帧
$vsampleSavePattern = Qiniu_Encode("qiniu_vsample_$(count)");
$vsampleFop = "vsample/png/ss/0/t/180/s/400x300/rotate/90/interval/10/pattern/" . $vsampleSavePattern;

$persistentOps = array(
    $watermarkAndConvertFop,
    $watermarkAndM3u8Fop,
    $vframeFop,
    $vsampleFop,
);
$putPolicy->PersistentOps = join(";", $persistentOps);
//队列默认为空，表示使用公用队列
$putPolicy->PersistentPipeline = "";
$returnBody = array(
    "bucket" => "$(bucket)",
    "fsize" => "$(fsize)",
    "fname" => "$(fname)",
    "etag" => "$(etag)",
    "key" => "$(key)",
    "persistentId" => "$(persistentId)",
    "exParam1" => "$(x:exParam1)",
    "exParam2" => "$(x:exParam2)",
    "exParam3" => "$(x:exParam3)",
    "exParam4" => "$(exParam4)", //这个扩展参数没有以x:开头，会被忽略
);
$putPolicy->ReturnBody = json_encode($returnBody);
$upToken = $putPolicy->Token($auth);
$localFile = "/Users/jemy/Documents/qiniu.mp4";
$key = "qiniu_20141231.mp4";

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