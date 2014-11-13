<?php
require("../../lib/qiniu/auth_digest.php");
require("../../qiniu_config.php");

$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
echo $Qiniu_AccessKey;
echo "<br/>";
echo $Qiniu_SecretKey;
echo "<br/>";
$path = '/~jemy/qiniu-lab-php/demos/service/callback_upload_service.php';
$body = 'fname=jemygraw.png&etag=FhtRgb4RjWdXtatInkRT3Pv7mp98&key=FhtRgb4RjWdXtatInkRT3Pv7mp98&exParam1=x&exParam2=worlda&exParam3=a';

$token=$mac->Sign($path."\n".$body);
echo $token;
