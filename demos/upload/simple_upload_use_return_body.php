<?php
$PAGE_TITLE = "简单上传-使用ReturnBody自定义返回内容";
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
//url format
//$returnBody="fname=$(fname)&fszie=$(fsize)&bucket=$(bucket)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
//self-defined format
//$returnBody="$(fname),$(fsize),$(bucket),$(x:exParam1),$(x:exParam2),$(x:exParam3)";
//json format
$returnBody = array("fname" => "$(fname)", "fsize" => "$(fsize)", "bucket" => "$(bucket)", "exParam1" => "$(x:exParam1)", "exParam2" => "$(x:exParam2)", "exParam3" => "$(x:exParam3)");
$returnBody = json_encode($returnBody);

$putPolicy -> ReturnBody = $returnBody;
$token = $putPolicy -> Token(null);
?>
<p class="title">
	简单上传-使用ReturnBody自定义返回内容
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验的目的是利用ReturnBody参数来自定义七牛上传文件成功之后的返回信息内容。默认情况下，返回的信息只有hash和key，但是我们可以使用变量来自定义返回内容。变量分为魔法变量和扩展变量。
		这样一来，我们就可以极大地丰富七牛的回复内容。
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
				include ("../code_snippet/php/simple_upload_use_return_body_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/simple_upload_use_return_body_java.html");
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
				{
				"fname":"golang_all.png",
				"fsize":"331763","bucket":"jemydemob",
				"exParam1":"hello","exParam2":"world",
				"exParam3":"qiniu"
				}
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
			默认情况下，七牛对上传成功的文件回复都是一个简单的hash，key组成的json字符串。我们也可以使用
			<a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html#magicvar">魔法变量</a>或者 <a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html#magicvar">扩展变量</a>来扩展我们的返回内容，这个时候
			你只需要多设置一个ReturnBody的参数即可。ReturnBody的格式其实可以是各种各样的，上面我们是使用了json的格式。
		</p>
		<p>
			其实你也可以使用url的格式，比如 <code>$returnBody="fname=$(fname)&fszie=$(fsize)&bucket=$(bucket)
				&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
			</code>
			<br/><br/>
			将会返回如下的内容：
			<code>
				fname="jemy.png"&fszie=12059&bucket="jemydemob"&
				exParam1="hello"&exParam2="world"&exParam3="qiniu"
			</code>
		</p>
		<p>
			甚至其他的任意格式，比如<code>$returnBody="$(fname),$(fsize),$(bucket),$(x:exParam1),$(x:exParam2),$(x:exParam3)";</code>
			七牛都会把对应的变量占位符替换为实际的值返回。<code>"golang_all.png",331763,"jemydemob","hello","world","qiniu"</code>。
		</p>
		<p>当然，如果说最佳实践，当然是json格式，次之为url格式，其他的不闲麻烦，都可以。</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>