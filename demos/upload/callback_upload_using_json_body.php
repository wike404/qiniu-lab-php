<?php
$PAGE_TITLE = "回调上传－以application/json方式传递回调内容";
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
$putPolicy -> CallbackUrl = $APP_ROOT . "/qiniu-lab-php/demos/service/callback_upload_service.php";
$callbackBody = array("fname" => "$(fname)", "etag" => "$(etag)", "key" => "$(key)", "exParam1" => "$(x:exParam1)", "exParam2" => "$(x:exParam2)", "exParam3" => "$(x:exParam3)");
$callbackBody = json_encode($callbackBody);
//your own server will get the callbackbody posted by qiniu server with a content-type of application/json
$putPolicy -> CallbackBodyType = "application/json";
$putPolicy -> CallbackBody = $callbackBody;
$token = $putPolicy -> Token(null);
?>
<p class="title">
	回调上传－以application/json方式传递回调内容（需设置callbackBodyType）
</p>

<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示了另外一种七牛服务器和业务服务器之间传递数据的格式，即json格式。在默认情况下，七牛服务器传递给
		业务服务器的数据是
		<code>
			application/x-www-form-urlencoded
		</code>
		的格式，我们可以设置PutPolicy
		里面的CallbackBodyType为
		<code>
			application/json
		</code>
		来让七牛服务器传递给业务服务器的格式为json格式。
		<br/>
		<br/>
		需要注意的是，业务服务器返回给七牛服务器的回复内容必须是
		<code>
			application/json
		</code>
		格式。
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
				include ("../code_snippet/php/callback_upload_using_json_body_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/callback_upload_using_json_body_java.html");
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
			<code>{"etag":"FrhEOhZZykO911Xe5KGNdRs7cDqN-1415201246","exParam1":"hello-1415201246",
				"exParam2":"world-1415201246","exParam3":"qiniu-1415201246",
				"fname":"golang.png-1415201246","key":"FrhEOhZZykO911Xe5KGNdRs7cDqN-1415201246"}</code>
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
			为了获得整个系统数据交换的一致性，选择以<code>application/json</code>的回调数据格式还是很有意义的。
		</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>