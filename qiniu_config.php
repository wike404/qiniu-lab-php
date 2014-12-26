<?php
$APP_CALLBACK_ROOT = "http://4b446d29.ngrok.com/~jemy/qiniu-lab-php";

$Qiniu_AccessKey = "<Your AccessKey>";
$Qiniu_SecretKey = "<Your SecretKey>";
$Qiniu_Public_Bucket = "<Public Bucket>";
$Qiniu_Private_Bucket = "<Private Bucket>";

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