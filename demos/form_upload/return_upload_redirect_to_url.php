<?php
$PAGE_TITLE = "上传重定向－文件上传成功后，七牛服务器重定向到指定的业务服务器地址";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
require_once ("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->ReturnUrl=$APP_ROOT."/demos/service/return_upload_service.php";
//url format
//$putPolicy->ReturnBody="fname=$(fname)&etag=$(etag)&key=$(key)&exParam1=$(x:exParam1)&exParam2=$(x:exParam2)&exParam3=$(x:exParam3)";
//json format
$returnBody=array(
	"fname"=>"$(fname)",
	"etag"=>"$(etag)",
	"key"=>"$(key)",
	"exParam1"=>"$(x:exParam1)",
	"exParam2"=>"$(x:exParam3)",
	"exParam3"=>"$(x:exParam3)",
);
$returnBody=json_encode($returnBody);
$putPolicy->ReturnBody=$returnBody;
$token = $putPolicy -> Token(null);
?>
<p class="title">
	上传重定向－文件上传成功后，七牛服务器重定向到指定的业务服务器地址
</p>

<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示了七牛服务器和业务服务器的另外一种数据交换方式，即重定向。这种模式一般适用于浏览器的上传方式，在上传时，可以在PutPolicy
		里面指定七牛服务器在接收到上传的文件之后，触发重定向行为，即跳转到指定的Url。你可以在PutPolicy里面使用ReturnUrl来指定七牛所要
		跳转到的服务器地址（公网，可访问），然后还可以设置PutPolicy里面的ReturnBody参数，设置方法类似回调，可以在ReturnBody里面使用
		变量（包括魔法变量和扩展变量）来提供跳转链接的Url参数数据。该Url参数名称为<code>upload_ret</code>，它是PutPolicy里面设置的
		ReturnBody经过七牛服务器填充变量值之后再做Url安全的Base64编码后得到的值。你可以在你接受跳转的页面用Url安全的Base64解码就可以看到
		ReturnBody里面的值了。
	</br><br/>
	在本实验中，接受回调的地址，将<code>upload_ret</code>解码输出。
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
				include ("../code_snippet/php/return_upload_redirect_to_url_php.html");
				?>
			</div>
			<div id="java-code">
				<?php
				include ("../code_snippet/java/return_upload_redirect_to_url_java.html");
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
				<strong>上传成功结果(ReturnBody以json格式组织)：</strong>
			</p>
			<code>
				{"fname":"golang_all.png","etag":"FpCxe5M4IMDh-jrJq9wofmeaTLwn",
				"key":"FpCxe5M4IMDh-jrJq9wofmeaTLwn","exParam1":"hello",
				"exParam2":"qiniu","exParam3":"qiniu"}
			</code>
		</div>
		<div class="tip">
			<p>
				<strong>上传成功结果(ReturnBody以url格式组织)：</strong>
			</p>
			<code>
				fname="golang.png"&etag="FrhEOhZZykO911Xe5KGNdRs7cDqN"
				&key="FrhEOhZZykO911Xe5KGNdRs7cDqN"&exParam1="hello"
				&exParam2="world"&exParam3="qiniu"
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
			重定向是适用于浏览器的一种功能，不过现在网页设计领域，上传文件都是以ajax的后台方式上传，这样才不影响用户体验，但是在某些
			情况下，重定向功能也还是有用的，这可能也是七牛提供这种方式的原因吧。另外需要注意的是重定向到你的业务服务器的值在参数<code>upload_ret</code>
			中，需要使用Url安全的Base64解码才能看到里面的真正的值，然后根据值的格式进行解析，获取需要的字段即可。
		</p>
	</div>
</div>
<?php
require ("../../footer.php");
?>