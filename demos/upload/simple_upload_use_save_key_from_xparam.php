<?php
	$PAGE_TITLE="简单上传-saveKey使用扩展参数";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	$putPolicy->SaveKey="$(x:saveKeyEx)";
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>简单上传-saveKey使用扩展参数</h1>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Token</span>
				<input name="token" type="text" value="<?php echo $token;?>"
					class="form-control" readonly="true"
				/>
			</div>
		</div>
		<div class="form-group">
			<input name="x:saveKeyEx" type="text" value="" class="form-control" placeholder="请设置 x:saveKeyEx 的值"/>
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
$putPolicy->SaveKey="$(x:saveKeyEx)";
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：（输入了扩展参数）</strong></p>
			<code>{"hash":"FpCxe5M4IMDh-jrJq9wofmeaTLwn","key":"qiniu_filename_test123","x:saveKeyEx":"qiniu_filename_test123"}</code>
	</div>
	<div class="tip">
		<p><strong>上传成功结果：（没有输入扩展参数，扩展参数为空，这时候文件名为空字符串）</strong></p>
		<code>{"hash":"Fp0XR6tM4yZmeiKXw7eZzmeyYsq8","key":"","x:saveKeyEx":""}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>
			{"error":"file is not specified in multipart"}
		</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			PutPolicy里面的saveKey在上传没有指定key的时候，会被当作文件名来使用，而这个saveKey的值却是可以通过变量的值来获取的。
			变量当然包括魔法变量和扩展变量。这里我们测试的是扩展变量，实践证明，是支持的。这种方式可以用来在需要终端用户自己设置文件名的场景下使用。
		</p>
	</div>
</div>
<?php require("../../footer.php");?>