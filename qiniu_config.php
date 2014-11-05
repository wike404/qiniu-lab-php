<?php
	//Your access key & secret key from https://portal.qiniu.com
	$Qiniu_AccessKey="";
	$Qiniu_SecretKey="";
	//Your public bucket for demo
	$Qiniu_Public_Bucket="";
	if(empty($Qiniu_AccessKey))
	{
		exit("<p class='alert alert-danger'>Error: Please set the access key in qiniu_config.php</p>");
	}
	if(empty($Qiniu_SecretKey))
	{
		exit("<p class='alert alert-danger'>Error: Please set the secret key in qiniu_config.php</p>");
	}
	if(empty($Qiniu_Public_Bucket))
	{
		exit("<p class='alert alert-danger'>Error: Please set a name for the public bucket in qiniu_config.php</p>");
	}
?>