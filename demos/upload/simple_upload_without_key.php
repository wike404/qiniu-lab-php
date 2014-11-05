<?php 	
	$PAGE_TITLE="简单文件上传－不指定key";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	//create token
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>简单文件上传－不指定key</h1>
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
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
<pre><code>require_once("../../lib/qiniu/rs.php");
$mac=new Qiniu_Mac($Qiniu_AccessKey,$Qiniu_SecretKey);
$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$token=$putPolicy->Token($mac);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：</strong></p>
			<code>{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":"FoaI_ZzokcGpZA48PVJPFNJvLoNc"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>
			{"error":"file is not specified in multipart"}
		</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			这种是最简单的上传方式，只指定了上传文件和需要的token。
			而七牛的后台会根据文件内容的<a href="https://github.com/qiniu/qetag">etag</a>来为文件命名。
			如果重复上传相同的文件内容，则七牛也只保留一个文件。
		</p>
	</div>
</div>
<?php require("../../footer.php");?>