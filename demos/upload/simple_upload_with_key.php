<?php
$PAGE_TITLE = "简单文件上传－指定上传文件的key";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>
<?php
require_once ("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$token = $putPolicy -> Token(null);
?>
<p class="title">
	简单上传-指定上传文件的key
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验的目的是演示上传时指定文件名，该文件名以form的参数提交，参数名称是key，七牛服务器将使用上传时指定的key的值来作为文件的名字。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
			<h1></h1>
			<div class="form-group">
				<input name="key" value="" placeholder="请指定上传文件key" class="form-control"/>
			</div>
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
				include ("../code_snippet/php/simple_upload_without_key_token_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_without_key_token_java.html");
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
				<strong>上传成功结果：（指定的key不为空，使用指定的key作为文件名）</strong>
			</p>
			<code>
				{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":"jemygraw.png"}
			</code>
		</div>
		<div class="tip">
			<p>
				<strong>上传成功结果：（指定的key为空，也可以上传成功，文件名就是空字符串）</strong></strong>
			</p>
			<code>
				{"hash":"FoaI_ZzokcGpZA48PVJPFNJvLoNc","key":""}
			</code>
		</div>
		<div class="tip">
			<p>
				<strong>上传失败结果：（重复上传key为空且内容不同的文件，会报错）</strong>
			</p>
			<code>
				{"error":"file exists"}
			</code>
		</div>
		<div class="tip">
			<p>
				<strong>上传失败结果：（重复上传指定的key相同的文件，但文件内容不同，也会报错）</strong>
			</p>
			<code>
				{"error":"file exists"}
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
		这种是最基本的上传方式，只指定了上传文件的key（七牛用来作为文件名），上传文件和需要的token。
		key可以指定为空，但是只能指定一次。因为多次上传相同的key的文件（内容不同）会报错。
		
		在实际应用过程中，要保证用户上传的文件不重名是很难的，这种情况下，我们可能需要对文件的名称加上一些
		唯一的前缀后者做一些特殊的处理而不应该简单地使用用户指定的文件名。这个时候可能就需要使用PutPolicy里面的saveKey参数。
	</div>
</div>
<?php
require ("../../footer.php");
?>