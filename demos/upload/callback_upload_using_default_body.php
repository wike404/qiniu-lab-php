<?php
$PAGE_TITLE = "回调上传－以application/x-www-form-urlencoded方式传递回调内容（默认）";
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
$putPolicy -> CallbackUrl = $APP_ROOT . "/demos/service/callback_upload_service.php";
$callbackBody = "fname=$(fname)&etag=$(etag)&key=$(key)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
//your own server will get the callbackbody posted by qiniu server with a content-type of application/x-www-form-urlencoded
$putPolicy -> CallbackBody = $callbackBody;
$token = $putPolicy -> Token(null);
?>
<p class="title">
	回调上传－以application/x-www-form-urlencoded方式传递回调内容（默认）
</p>

<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示了一种使七牛服务器和你自己的业务服务器对上传文件的信息进行交互的一种方式。在生成上传的Token的时候，在PutPolicy里面设置
		相关的回调地址，约定的传给回调地址的回调数据，以及可选的设置回调数据的格式（Content-Type）来实现文件上传完毕之后，七牛服务器和你的
		业务服务器之间的数据交换。细节参考<a href="http://developer.qiniu.com/docs/v6/api/overview/up/response/callback.html">文档</a>。
		<br/><br/>
		七牛和业务服务器之间默认交换数据的格式是<code>application/x-www-form-urlencoded</code>方式。所以在组织CallbackBody的时候要注意数据的组织格式。
		<br/><br/>
		这个实验的回调地址将解析CallbackBody中的每个变量值，并且附加一个时间戳返回。
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
				include ("../code_snippet/php/callback_upload_using_default_body_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/callback_upload_using_default_body_php.html");
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
			<p><strong>回调失败结果：</strong></p>
			<code>
				{"error":"{\"callback_url\":\"http://localhost/~jemy/qiniu-lab-php/demos/service/callback_upload_service.php\",
				\"callback_bodyType\":\"application/x-www-form-urlencoded\",
				\"callback_body\":\"fname=jemy_smile.png\\u0026etag=Fkvyx8owOun_AyFpeOVEogiNYG2X\\u0026
				key=Fkvyx8owOun_AyFpeOVEogiNYG2X\\u0026exParam1=hello\\u0026exParam2=world\\u0026exParam3=qiniu\",
				\"token\":\"\",\"err_code\":0,\"error\":\"Post http://localhost/~jemy/qiniu-lab-php/demos/service/
				callback_upload_service.php: dial tcp 127.0.0.1:80: connection refused\"}"}
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
			业务服务器和七牛服务器之间的数据交换简单来讲如下：
			<ol>
				<li>业务服务器在PutPolicy里面指定上传完成后的回调地址CallbackUrl和回调数据内容CallbackBody，然后颁发上传Token给文件上传端。</li>
				<li>文件上传端上传数据到七牛服务器，可以采用各种上传方式。</li>
				<li>七牛服务器在保持上传文件的时候，会检查上传Token中第三部分内容，即被Url安全的Base64编码的PutPolicy，发现CallbackUrl和CallbackBody。</li>
				<li>七牛服务器根据CallbackBody的内容，可能进行变量的值填充（魔法变量和扩展变量）。</li>
				<li>七牛服务器把CallbackBody的内容以HTTP的POST请求传递给业务服务器的CallbackUrl。</li>
				<li>业务服务器接受到七牛服务器传递过来的数据，然后给出一个Content-Type: application/json的回复给七牛服务器。</li>
				<li>七牛服务器把上面业务服务器返回的json格式回复原封不动地送给文件上传端。</li>
			</ol>
			当然，如果七牛回调到业务服务器失败，七牛服务器会返回失败信息给文件上传端。
		</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>