<?php 	
	$PAGE_TITLE="简单文件上传－指定上传文件的key";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>指定上传文件的key</h1>
		<div class="form-group">
			<input name="key" value="" placeholder="请指定上传文件key" class="form-control"/>
		</div>
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
<pre><code>require_once("../qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：（指定的key不为空，使用指定的key作为文件名）</strong></p>
		<code>{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":"jemygraw.png"}</code>
	</div>
	<div class="tip">
		<p><strong>上传成功结果：（指定的key为空，也可以上传成功，文件名就是空字符串）</strong></strong></p>
		<code>{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":""}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（重复上传key为空且内容不同的文件，会报错）</strong></p>
		<code>{"error":"file exists"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（重复上传指定的key相同的文件，但文件内容不同，也会报错）</strong></p>
		<code>{"error":"file exists"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>{"error":"file is not specified in multipart"}</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			这种是最基本的上传方式，只指定了上传文件的key（七牛用来作为文件名），上传文件和需要的token。
			key可以指定为空，但是只能指定一次。因为多次上传相同的key的文件（内容不同）会报错。
		</p>
	</div>
</div>
<?php require("../../footer.php");?>