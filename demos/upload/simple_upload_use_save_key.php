<?php
$PAGE_TITLE = "简单文件上传－使用saveKey作为文件名";
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
//use a random key for saveKey
$putPolicy -> SaveKey = "qiniu_cloud_storage_" . time();
$token = $putPolicy -> Token(null);
?>
<p class="title">
	简单上传-使用saveKey作为文件名
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验使用了一个随机的文件名来作为上传文件的名字，演示了七牛提供的另一种指定文件key的方式。
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
				include ("../code_snippet/php/simple_upload_use_save_key_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_use_save_key_java.html");
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
				{"hash":"FrhEOhZZykO911Xe5KGNdRs7cDqN","key":"qiniu_cloud_storage_1415170971"}
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
		<p>
			上面的例子中，我们使用了一个随机数作为PutPolicy里面的SaveKey，在没有指定Key（没有把Key参数放在POST请求中提交）的情况下，
			七牛服务器会使用备选参数SaveKey来作为文件的名字。
			
			在上面我们曾经说过，如果上传指定的文件key相同的文件的时候，七牛会告诉你该文件已经存在了。但是我们又无法让客户都能够指定不同文件
			的key，在这种情况下，可以使用随机生成的SaveKey来作为上传文件的名字，这样即使上传的文件内容相同，也会被当作不同的文件存储下来。
			
			当然了，还有一种方式是结合指定的文件前缀的方式来设置SaveKey，这个我们在下面的实验中会看到。
		</p>

	</div>
</div>
<?php
require ("../../footer.php");
?>