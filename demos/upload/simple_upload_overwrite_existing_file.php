<?php
$PAGE_TITLE = "简单文件上传－文件覆盖上传";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>
<?php
require_once ("../../lib/qiniu/rs.php");
if (isset($_GET["keyToOverwrite"])) {
	$keyToOverwrite = $_GET["keyToOverwrite"];
	if (!empty($keyToOverwrite)) {
		Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
		$putPolicy -> Scope = $Qiniu_Public_Bucket . ":" . $keyToOverwrite;
		$putPolicy -> InsertOnly = 0;
		$token = $putPolicy -> Token(null);
	}
}
?>
<p class="title">
	简单文件上传－文件覆盖上传
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验的目的是演示如何覆盖上传一个已存在的文件(即同名key存在)。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<?php if(empty($keyToOverwrite)){
		?>
		<form method="GET" action="" role="form">
			<div class="form-group">
				<input name="keyToOverwrite" value="" placeholder="输入需要覆盖的文件的key" class="form-control"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Go Next" class="btn btn-primary"/>
			</div>
		</form>
		<?php
		}
		?>
		<?php if(!empty($keyToOverwrite)){
		?>
		<form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">覆盖文件key</span>
					<input name="key" value="<?php echo $keyToOverwrite; ?>" placeholder="" readonly="true" class="form-control"/>
				</div>
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
		<?php
		}
		?>
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
				include ("../code_snippet/php/simple_upload_overwrite_existing_file_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_overwrite_existing_file_java.html");
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
				<strong>上传成功结果：（如果同名文件存在，则被覆盖，不管内容是否相同）</strong>
			</p>
			<code>
				{"hash":"Fp0XR6tM4yZmeiKXw7eZzmeyYsq8","key":"qiniu.png"}
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
			覆盖上传文件注意以下几点即可：
			<ol>
				<li>
					提交的表单里面必须要有一个名字叫做key的参数
				</li>
				<li>
					PutPolicy的Scope设置方式为bucket:key
				</li>
				<li>
					PutPolicy的属性InsertOnly设置为0
				</li>
			</ol>
		</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>