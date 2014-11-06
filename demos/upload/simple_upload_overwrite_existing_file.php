<?php 	
	$PAGE_TITLE="简单文件上传－文件覆盖上传";
?>
<?php require("../../header.php");?>
<?php require("../../qiniu_config.php");?>
<?php 
	require_once("../../lib/qiniu/rs.php");
	$keyToOverwrite=$_GET["keyToOverwrite"];
	if(!empty($keyToOverwrite))
	{
		Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
		$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
		$putPolicy->Scope=$Qiniu_Public_Bucket.":".$keyToOverwrite;
		$putPolicy->InsertOnly=0;
		$token=$putPolicy->Token(null);
	}
?>

<?php if(empty($keyToOverwrite)){?>
<div class="box">
	<form method="GET" action="" role="form">
		<h1>输入要覆盖文件的文件名（key）</h1>
		<div class="form-group">
			<input name="keyToOverwrite" value="" placeholder="需要覆盖的文件的key" class="form-control"/>
		</div>
		<div class="form-group">
			<input type="submit" value="Go Next" class="btn btn-primary"/>
		</div>
	</form>
</div>
<?php
}
?>

<?php if(!empty($keyToOverwrite)){ ?>
<div class="box">
	<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
		<h1>文件覆盖上传</h1>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">覆盖文件key</span>
				<input name="key" value="<?php echo $keyToOverwrite;?>" placeholder="" readonly="true" class="form-control"/>
			</div>
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
<pre><code>require_once("../../lib/qiniu/rs.php");
$keyToOverwrite=$_GET["keyToOverwrite"];
if(!empty($keyToOverwrite))
{
	Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
	$putPolicy=new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
	$putPolicy->Scope=$Qiniu_Public_Bucket.":".$keyToOverwrite;
	$putPolicy->InsertOnly=0;
	$token=$putPolicy->Token(null);
}
</code></pre>
</div>
<div class="box">
	<div class="tip">
		<p><strong>上传成功结果：（如果同名文件存在，则被覆盖，不管内容是否相同）</strong></p>
		<code>{"hash":"Fp0XR6tM4yZmeiKXw7eZzmeyYsq8","key":"qiniu.png"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（如果指定key的文件在空间不存在，则报错）</strong></p>
		<code>{"error":"key doesn't match with scope"}</code>
	</div>
	<div class="tip">
		<p><strong>上传失败结果：（未指定文件错误）</strong></p>
		<code>{"error":"file is not specified in multipart"}</code>
	</div>
	<div class="tip alert alert-success">
		<p>
			覆盖上传文件注意以下几点即可：
			<ol>
				<li>提交的表单里面必须要有一个名字叫做key的参数</li>
				<li>PutPolicy的Scope设置方式为bucket:key</li>
				<li>PutPolicy的属性InsertOnly设置为0</li>
				<li>所指定要覆盖的文件的key必须存在，否则报错</li>
			</ol>
		</p>
	</div>
</div>
<?php
}
?>
<?php require("../../footer.php");?>