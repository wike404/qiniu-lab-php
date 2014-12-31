<?php
$PAGE_TITLE = "简单文件上传－不指定上传文件的key";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>
<?php
//create token
require_once ("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$token = $putPolicy -> Token(null);
?>
<p class="title">
	简单上传-不指定上传文件key
</p>

<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验的目的是迅速体验一下七牛的文件上传服务，你可以上传任何一个文件到七牛的服务器，而不需要指定一个名字。
		七牛服务器会根据文件的内容来计算这个文件标识符来作为文件的名字（即key）。
		计算文件标识符的算法参考<a href="https://github.com/qiniu/qetag">etag</a>。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Token</span>
					<input name="token" type="text" value="<?php echo $token; ?>"
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
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		代码
	</div>
	<div class="panel-body">
		<div id="code-tabs">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation">
					<a href="#php-code">PHP</a>
				</li>
				<li role="presentation">
					<a href="#java-code">Java</a>
				</li>
			</ul>
			<div id="php-code">
				<?php
				include ("../code_snippet/php/simple_upload_with_key_token_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_with_key_token_java.html");
				?>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		结果
	</div>
	<div class="panel-body">
		<div class="tip">
			<p>
				<strong>上传成功结果：</strong>
			</p>
			<code>
				{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":"FoaI_ZzokcGpZA48PVJPFNJvLoNc"}
			</code>

		</div>
		<div class="tip">
			<p>
				<strong>上传失败结果：（未指定文件错误）</strong>
			</p>
			<code>
				{"error":"file is not specified in multipart"}
			</code>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		备注
	</div>
	<div class="panel-body">
		这种是最简单的上传方式，只指定了上传文件和需要的token。
		而七牛的后台会根据文件内容的<a href="https://github.com/qiniu/qetag">etag</a>来为文件命名。
		如果重复上传相同的文件内容，则七牛也只保留一个文件。
		默认上传完之后，七牛服务器返回的是Content-Type为application/json的json格式字符串。
	</div>
</div>
<?php
require ("../../footer.php");
?>