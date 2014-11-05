<?php
	$PAGE_TITLE="简单上传-使用ReturnBody自定义返回内容";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	require_once("../../lib/qiniu/rs.php");
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	//url format
	//$returnBody="fname=$(fname)&fszie=$(fsize)&bucket=$(bucket)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
	//json format
	$returnBody=array(
		"fname"=>"$(fname)",
		"fsize"=>"$(fsize)",
		"bucket"=>"$(bucket)",
		"exParam1"=>"$(x:exParam1)",
		"exParam2"=>"$(x:exParam2)",
		"exParam3"=>"$(x:exParam3)"
	);
	$returnBody=json_encode($returnBody);
	$putPolicy->ReturnBody=$returnBody;
	$token=$putPolicy->Token(null);
?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>使用ReturnBody自定义返回内容</h1>
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
//json format
$returnBody=array(
	"fname"=>"$(fname)",
	"fsize"=>"$(fsize)",
	"bucket"=>"$(bucket)",
	"exParam1"=>"$(x:exParam1)",
	"exParam2"=>"$(x:exParam2)",
	"exParam3"=>"$(x:exParam3)"
);
$returnBody=json_encode($returnBody);
$putPolicy->ReturnBody=$returnBody;
$token=$putPolicy->Token(null);
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：</strong></p>
		<code>{"fname":"golang_all.png","fsize":"331763","bucket":"jemydemob","exParam1":"hello","exParam2":"world","exParam3":"qiniu"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>
			{"error":"file is not specified in multipart"}
		</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			默认情况下，七牛对上传成功的文件回复都是一个简单的hash，key组成的json字符串。我们也可以使用
			<a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html#magicvar">魔法变量</a>或者
			<a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html#magicvar">扩展变量</a>来扩展我们的返回内容，这个时候
			你只需要多设置一个ReturnBody的参数即可。
		</p>
	</div>
</div>
<?php require("../../footer.php");?>