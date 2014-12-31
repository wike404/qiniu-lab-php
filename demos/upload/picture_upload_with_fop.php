<?php
require_once("../../qiniu_config.php");
require_once("../../lib/qiniu/io.php");
require_once("../../lib/qiniu/rs.php");
require_once("print_result.php");

//带图片处理的文件上传
$auth = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

//缩略图
$imgResizeSaveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_1024x768.jpg");
$imgResizeFop = "imageView2/0/w/1024/h/768/format/jpg/q/100/interlace/1|saveas/" . $imgResizeSaveas;
//裁减
$imgCrop1Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop1.jpg");
$imgCrop1Fop = "imageMogr2/gravity/NorthEast/crop/!600x800a10a20|saveas/" . $imgCrop1Saveas;

$imgCrop2Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop2.jpg");
$imgCrop2Fop = "imageMogr2/gravity/NorthWest/crop/!600x800a10a20|saveas/" . $imgCrop2Saveas;

$imgCrop3Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop3.jpg");
$imgCrop3Fop = "imageMogr2/gravity/West/crop/!600x800a10a20|saveas/" . $imgCrop3Saveas;

$imgCrop4Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop4.jpg");
$imgCrop4Fop = "imageMogr2/gravity/East/crop/!600x800a10a20|saveas/" . $imgCrop4Saveas;

$imgCrop5Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop5.jpg");
$imgCrop5Fop = "imageMogr2/gravity/SouthWest/crop/!600x800a10a20|saveas/" . $imgCrop5Saveas;

$imgCrop6Saveas = Qiniu_Encode($Qiniu_Public_Bucket . ":qiniu_logo_20141231_crop6.jpg");
$imgCrop6Fop = "imageMogr2/gravity/SouthEast/crop/!600x800a10a20|saveas/" . $imgCrop6Saveas;


$persistentOps = array(
    $imgResizeFop,
    $imgCrop1Fop,
    $imgCrop2Fop,
    $imgCrop3Fop,
    $imgCrop4Fop,
    $imgCrop5Fop,
    $imgCrop6Fop,
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
$localFile = "/Users/jemy/Pictures/Backgroud/20141031_01.jpg";
$key = "qiniu_logo_20141231.png";

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
QiniuLab_PrintUploadResult($ret, $err);