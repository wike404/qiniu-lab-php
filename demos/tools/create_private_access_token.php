<?php
$PAGE_TITLE = "创建私有资源访问Token";
require_once ("../../header.php");
require_once ("../../qiniu_config.php");
require_once ("../../lib/qiniu/auth_digest.php");
?>

<?php
date_default_timezone_set('Asia/Shanghai');
if (isset($_POST["bucket"]) && isset($_POST["key"])) {
	$bucket = $_POST["bucket"];
	$key = $_POST["key"];
	$expire = $_POST["expire"];
	if (!empty($bucket) && !empty($key) && !empty($expire)) {
		$timestamp = strtotime($expire);
		$srcUrl = sprintf("http://%s.qiniudn.com/%s", $bucket, urlencode($key));
		$srcUrl = sprintf("%s?e=%d", $srcUrl, $timestamp);
		$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
		$accessToken = $mac -> Sign($srcUrl);
		$newUrl = sprintf("%s&token=%s", $srcUrl, $accessToken);
	}
}
if (isset($_POST["resSrcUrl"]) && isset($_POST["resExpire"])) {
	$resSrcUrl = $_POST["resSrcUrl"];
	$resExpire = $_POST["resExpire"];
	if (!empty($resSrcUrl) && !empty($resExpire)) {
		$timestamp = strtotime($resExpire);
		if (strpos($resSrcUrl, "?") !== false) {
			$resSrcUrl = sprintf("%s&e=%d", $resSrcUrl, $timestamp);
		} else {
			$resSrcUrl = sprintf("%s?e=%d", $resSrcUrl, $timestamp);
		}
		$mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
		$resAccessToken = $mac -> Sign($resSrcUrl);
		$newResUrl = sprintf("%s&token=%s", $resSrcUrl, $resAccessToken);
	}
}
?>
<p class="title">
	创建私有资源访问Token
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示如何创建私有空间中文件访问所需要的Token，具体参考<a href="http://developer.qiniu.com/docs/v6/api/reference/security/download-token.html">文档</a>。
		该例子使用
		<code>
			qiniudn.com
		</code>
		的默认域名，如果你需要其他的域名只需要改一下域名即可。
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				实验1 - 常规私有资源访问
			</div>
			<div class="panel-body">
				<form method="post" action="" role="form">
					<div class="form-group">
						<input name="bucket" value="<?php
						if (isset($bucket)) {echo $bucket;
						}
					?>" placeholder="请指定空间名称" class="form-control"/>
					</div>
					<div class="form-group">
						<input name="key" value="<?php
						if (isset($key)) {echo $key;
						}
					?>" placeholder="请指定文件的key" class="form-control"/>
					</div>
					<div class="form-group">
						<input name="expire" value="<?php if(isset($expire)) {echo $expire;}?>" placeholder="请指定过期时间, 格式yyyy-MM-dd HH:mm:ss" class="form-control"/>
					</div>
					<div class="form-group">
						<input type="submit" value="生成私有资源访问Token" class="btn btn-info"/>
					</div>
				</form>
				<div class="form-group">
					<input name="key" value="<?php
					if (isset($accessToken)) {echo $accessToken;
					}
					?>" placeholder="生成的Token" class="form-control" readonly="true"/>
				</div>
				<div class="form-group">
					<input name="key" value="<?php
					if (isset($newUrl)) {echo $newUrl;
					}
					?>" placeholder="生成的私有资源访问链接" class="form-control" readonly="true"/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				实验2 - 带实时fop的私有链接访问
			</div>
			<div class="panel-body">
				<form method="post" action="" role="form">
					<div class="form-group">
						<input name="resSrcUrl" value="<?php if(isset($resSrcUrl)){echo $resSrcUrl;}?>" placeholder="请指定访问链接" class="form-control"/>
					</div>
					<div class="form-group">
						<input name="resExpire" value="<?php if(isset($resExpire)){echo $resExpire;}?>" placeholder="请指定过期时间, 格式yyyy-MM-dd HH:mm:ss" class="form-control"/>
					</div>
					<div class="form-group">
						<input type="submit" value="生成私有资源访问Token" class="btn btn-info"/>
					</div>
				</form>
				<div class="form-group">
					<input name="key" value="<?php
					if (isset($newResUrl)) {echo $newResUrl;
					}
					?>" placeholder="生成的私有资源访问链接" class="form-control" readonly="true"/>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once ("../../footer.php");
?>