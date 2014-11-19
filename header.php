<?php
	$APP_ROOT="http://localhost/~jemy/qiniu-lab-php";
	if (!isset($PAGE_TITLE))
	{
		$PAGE_TITLE="七牛实验室";
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" href="<?php echo $APP_ROOT;?>/public/css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="<?php echo $APP_ROOT;?>/public/css/bootstrap-theme.min.css"></link>
	<link rel="stylesheet" href="<?php echo $APP_ROOT;?>/public/css/style.css"></link>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/public/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/public/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/public/js/main.js"></script>
	<title><?php echo $PAGE_TITLE;?></title>
</head>
<body>
	<div class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" 
			data-toggle="collapse" data-target="#menu-navbar-collapse">
				<span class="sr-only">导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $APP_ROOT;?>">
				<table>
					<tr>
						<td><img class="navbar-logo" src="<?php echo $APP_ROOT;?>/public/images/qiniu.png"/></td>
						<td>&nbsp;七牛实验室</td>
					</tr>
				</table>
			</a>			
		</div>
		  
	 	<div class="collapse navbar-collapse" id="menu-navbar-collapse">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">官网 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a target="_blank" href="http://developer.qiniu.com">开发者文档</a></li>
					<li><a target="_blank" href="http://segmentfault.com/qiniu">开发者问答</a>
				</ul>
	        </li>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">基础工具 <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT?>/demos/tools/create_private_access_token.php">创建私有资源访问Token</a></li>
	        	</ul>
	        </li>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">API实例-Form模式 <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_without_key.php">简单上传-不指定上传文件key</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_with_key.php">简单上传-指定上传文件key</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_use_save_key.php">简单上传-使用saveKey作为文件名</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_use_save_key_from_xparam.php">简单上传-使用扩展参数作为saveKey</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_use_return_body.php">简单上传-使用ReturnBody自定义返回内容</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/simple_upload_overwrite_existing_file.php">简单上传-文件覆盖上传</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/callback_upload_using_default_body.php">回调上传－以application/x-www-form-urlencoded方式传递回调内容（默认）</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/callback_upload_using_json_body.php">回调上传－以application/json方式传递回调内容（需设置callbackBodyType）</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/upload/return_upload_redirect_to_url.php">上传重定向－文件上传成功后，七牛服务器重定向到指定的业务服务器地址</a></li>
	        	</ul>
	        </li>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 资源管理 <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/fop/pfop.php">触发持久化</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/rs/rs_stat.php">Stat获取文件基本信息</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/rs/rs_copy.php">Copy将指定资源复制为新命名资源</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/rs/rs_move.php">Move将源空间的指定资源移动到目标空间</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/demos/rs/rs_delete.php">Delete删除指定空间中的文件</a></li>
	        	</ul>
	        </li>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">常用工具 <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT;?>/tools/base64_url_safe.php">Url安全Base64编码/解码</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/tools/unix_timestamp.php">Unix时间戳转换</a></li>
	        	</ul>
	        </li>
	      </ul>
		</div>
	</div>
	<div id="main" class="container">