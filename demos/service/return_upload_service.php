<?php
require_once("../../lib/qiniu/utils.php");
if(isset($_GET["upload_ret"]))
{
	$uploadRet=$_GET["upload_ret"];
	//decode using urlsafe base64
	$uploadRet=Qiniu_Decode($uploadRet);
	echo $uploadRet;
}
else
{
	echo "Error: No param `upload_ret' specified in redirect request.";	
}
