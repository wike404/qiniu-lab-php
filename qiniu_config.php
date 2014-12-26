<?php
$Qiniu_AccessKey = "yxr8_XZK1YtCxWQbO-wX--yYlA1LfbB661AmFOBD";
$Qiniu_SecretKey = "kPjvaggdivMcKqJmnYfj-ue8iOPIAOMk30I3gEnK";
$Qiniu_Public_Bucket = "if-pbl";
$Qiniu_Private_Bucket = "if-pri";

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