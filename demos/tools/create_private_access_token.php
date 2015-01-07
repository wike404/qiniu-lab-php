<?php
$PAGE_TITLE = "创建私有资源访问Token";
require_once ("../../header.php");
require_once ("../../qiniu_config.php");
require_once ("../../lib/qiniu/auth_digest.php");
?>

<?php
date_default_timezone_set('Asia/Shanghai');
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
		该实验演示如何创建私有空间中文件访问所需要的Token，具体参考<a href="http://developer.qiniu.com/docs/v6/api/reference/security/download-token.html">文档</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				实验
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
    <div class="col-md-6">
        <p>
            步骤:<br/>
            <ol>
                <li>找到空间对应的下载域名，比如我的私有空间if-pri对应的下载域名是http://7qnctm.com1.z0.glb.clouddn.com</li>
                <li>找到文件名作为key，附加在http://7qnctm.com1.z0.glb.clouddn.com后面，构成http://7qnctm.com1.z0.glb.clouddn.com/key</li>
                <li>将上面的资源链接填入“访问链接”输入框</li>
                <li>如果链接是带fop操作的，那么在http://7qnctm.com1.z0.glb.clouddn.com/key后面，先接上fop相关指令参数，比如http://7qnctm.com1.z0.glb.clouddn.com/key?imageView2/0/1/w/100，再填入“访问链接”输入框</li>
                <li>输入该完整访问链接的过期时间</li>
            </ol>
        </p>
    </div>
</div>

<?php
require_once ("../../footer.php");
?>