<?php
$PAGE_TITLE = "简单上传-使用扩展参数作为saveKey";
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
$putPolicy -> SaveKey = "$(x:saveKeyEx)$(fname)";
$token = $putPolicy -> Token(null);
?>
<p class="title">
	简单上传-使用扩展参数作为saveKey
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示了SaveKey的另外一种用法，你可以设置一个扩展参数来作为文件名的前缀，这个前缀你可以通过自己的程序生成，然后作为hidden
		字段，这里我们让这个扩展参数显示出来，可以让你手动输入一个前缀体验一下。
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
				include ("../code_snippet/php/simple_upload_use_save_key_from_xparam_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_use_save_key_from_xparam_java.html");
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
				<strong>上传成功结果：（输入了扩展参数）</strong>
			</p>
			<code>
				{
					"hash":"Fp0XR6tM4yZmeiKXw7eZzmeyYsq8",
					"key":"2014/11/15/jemygraw/pics/jemy.png",
					"x:saveKeyEx":"2014/11/15/jemygraw/pics/"
				}
			</code>
		</div>
		<div class="tip">
			<p>
				<strong>上传成功结果：（没有输入扩展参数，扩展参数为空，这时候文件名为空字符串）</strong>
			</p>
			<code>
				{"hash":"Fp0XR6tM4yZmeiKXw7eZzmeyYsq8","key":"","x:saveKeyEx":""}
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
			PutPolicy里面的saveKey在上传没有指定key的时候，会被当作文件名来使用，而这个saveKey的值却是可以通过变量的值来获取的。
			变量当然包括魔法变量和扩展变量。这里我们测试的是扩展变量，实践证明，是支持的。这种方式可以用来在需要终端用户自己设置文件名的场景下使用。
		</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>