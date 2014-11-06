<?php
	$PAGE_TITLE="回调上传－以application/x-www-form-urlencoded方式传递回调内容（默认）";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	$putPolicy->CallbackUrl=$APP_ROOT."/qiniu-lab-php/demos/service/callback_upload_service.php";
	$callbackBody="fname=$(fname)&etag=$(etag)&key=$(key)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
	//your own server will get the callbackbody posted by qiniu server with a content-type of application/x-www-form-urlencoded
	$putPolicy->CallbackBody=$callbackBody;
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>以application/x-www-form-urlencoded方式传递回调内容（默认）</h1>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Token</span>
				<input name="token" type="text" value="<?php echo $token;?>"
					class="form-control" readonly="true"
				/>
			</div>
		</div>
		<div class="form-group">
			<input name="x:exParam1" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
		</div>
		<div class="form-group">
			<input name="x:exParam2" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
		</div>
		<div class="form-group">
			<input name="x:exParam3" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
		</div>
		<div class="form-group">
			<input name="file" type="file"/>
		</div>
		<div class="form-group">
			<input type="submit" value="Upload" class="btn btn-primary"/>
		</div>
	</form>
</div>

<div class="box">
<pre><code>require_once("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->CallbackUrl=$APP_ROOT."/qiniu-lab-php/demos/service/callback_upload_service.php";
$callbackBody="fname=$(fname)&etag=$(etag)&key=$(key)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
$putPolicy->CallbackBody=$callbackBody;
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：</strong></p>
		<code>{"etag":"FrhEOhZZykO911Xe5KGNdRs7cDqN-1415201246","exParam1":"hello-1415201246",
			"exParam2":"world-1415201246","exParam3":"qiniu-1415201246",
			"fname":"golang.png-1415201246","key":"FrhEOhZZykO911Xe5KGNdRs7cDqN-1415201246"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>
			{"error":"file is not specified in multipart"}
		</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			文档参考<a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/callback.html">回调</a>
		</p>
	</div>
</div>
<?php require("../../footer.php");?>