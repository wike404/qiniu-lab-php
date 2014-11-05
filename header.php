<?php
	$APP_ROOT="http://localhost/~jemy";
	if (!isset($PAGE_TITLE))
	{
		$PAGE_TITLE="七牛实验室";
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" href="<?php echo $APP_ROOT;?>/qiniu-lab-php/public/css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="<?php echo $APP_ROOT;?>/qiniu-lab-php/public/css/style.css"></link>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/qiniu-lab-php/public/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $APP_ROOT;?>/qiniu-lab-php/public/js/bootstrap.min.js"></script>
	<title><?php echo $PAGE_TITLE;?></title>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" 
			data-toggle="collapse" data-target="#menu-navbar-collapse">
				<span class="sr-only">导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $APP_ROOT;?>/qiniu-lab-php">七牛实验室</a>
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
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> API实例-Form模式 <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/demos/upload/simple_upload_without_key.php">简单上传（不带key）</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/demos/upload/simple_upload_with_key.php">简单上传（指定key）</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/demos/upload/simple_upload_use_save_key.php">简单上传（使用saveKey）</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/demos/upload/simple_upload_use_save_key_from_xparam.php">简单上传（saveKey使用扩展参数）</a></li>
	        		<li class="divider"></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/demos/upload/simple_upload_use_return_body.php">使用ReturnBody自定义返回内容</a></li>
	        	</ul>
	        </li>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 常规工具<span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/tools/base64_url_safe.php">Url Safe Base64 Encode/Decode</a></li>
	        		<li><a href="<?php echo $APP_ROOT;?>/qiniu-lab-php/tools/unix_timestamp.php">Unix Timestamp</a></li>
	        	</ul>
	        </li>
	      </ul>
		</div>
	</nav>
	<div id="main" class="container">