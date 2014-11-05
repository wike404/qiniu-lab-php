<?php 	
	$PAGE_TITLE="简单文件上传－使用saveKey作为文件名";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	//create token
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	//use a random key for saveKey
	$putPolicy->SaveKey="qiniu_cloud_storage_".time();
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>使用saveKey作为文件名</h1>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Token</span>
				<input name="token" type="text" value="<?php echo $token;?>"
					class="form-control" readonly="true"
				/>
			</div>
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
//use a random key for saveKey
$putPolicy->SaveKey="qiniu_cloud_storage_".time();
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：</strong></p>
			<code>{"hash":"FrhEOhZZykO911Xe5KGNdRs7cDqN","key":"qiniu_cloud_storage_1415170971"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>
			{"error":"file is not specified in multipart"}
		</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			上面的例子中，我们使用了一个随机数作为PutPolicy里面的SaveKey，在没有指定Key（没有把Key参数放在POST请求中提交）的情况下，七牛服务器会使用备选参数SaveKey来作为文件的名字。
		</p>
	</div>
</div>
<?php require("../../footer.php");?>