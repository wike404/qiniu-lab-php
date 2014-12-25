<?php
if(!isset($_SESSION))
{
    session_start();
}
$Qiniu_AccessKey = "";
$Qiniu_SecretKey = "";
$Qiniu_Public_Bucket = "";
$Qiniu_Private_Bucket = "";
if (isset($_SESSION["Qiniu_AccessKey"])) {
    $Qiniu_AccessKey = $_SESSION["Qiniu_AccessKey"];
}
if (isset($_SESSION["Qiniu_SecretKey"])) {
    $Qiniu_SecretKey = $_SESSION["Qiniu_SecretKey"];
}
if (isset($_SESSION["Qiniu_PublicBucket"])) {
    $Qiniu_Public_Bucket = $_SESSION["Qiniu_PublicBucket"];
}
if (isset($_SESSION["Qiniu_PrivateBucket"])) {
    $Qiniu_Private_Bucket = $_SESSION["Qiniu_PrivateBucket"];
}

if (empty($Qiniu_AccessKey)) {
    exit("<p class='alert alert-danger'>Error: Please set the access key</p>");
}
if (empty($Qiniu_SecretKey)) {
    exit("<p class='alert alert-danger'>Error: Please set the secret key</p>");
}
if (empty($Qiniu_Public_Bucket)) {
    exit("<p class='alert alert-danger'>Error: Please set a name for the public bucket</p>");
}
if (empty($Qiniu_Private_Bucket)) {
    exit("<p class='alert alert-danger'>Error: Please set a name for the private bucket</p>");
}
?>