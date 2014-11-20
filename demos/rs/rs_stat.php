<?php
$PAGE_TITLE = "Stat获取文件基本信息";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>

<p class="title">
	Stat获取文件基本信息
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示如何获取文件的基本信息。具体细节参考<a href="http://developer.qiniu.com/docs/v6/api/reference/rs/stat.html">文档</a>。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form method="post" action="<?php echo $APP_ROOT; ?>/demos/rs/rs_stat_action.php"
		role="form" id="rs-stat-form">
			<div class="form-group">
				<input name="bucket" value="" placeholder="请指定空间名称" class="form-control"/>
			</div>
			<div class="form-group">
				<input name="key" value="" placeholder="请指定文件的key" class="form-control"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Stat" class="btn btn-info"/>
			</div>
		</form>
		<p class="alert alert-danger" id="form-error" style="display: none;"></p>
		<p class="alert alert-info" id="form-info" style="display: none;"></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var rsStatForm = $("#rs-stat-form");
		var formError = $("#form-error");
		var formInfo = $("#form-info");
		rsStatForm.submit(function(event) {
			event.preventDefault();
			var actionUrl = rsStatForm.attr("action");
			var bucket = rsStatForm.find("input[name='bucket']")[0].value;
			var key = rsStatForm.find("input[name='key']")[0].value;
			bucket = $.trim(bucket);
			key = $.trim(key);
			$.post(actionUrl, {
				bucket : bucket,
				key : key,
			}, function(respData) {
				var error = respData.error;
				if (error != undefined) {
					formError.text(error);
					formError.show();
					formInfo.hide();
				} else {
					var data = respData[0];
					var error = respData[1];
					if (data != null) {
						var fsize = data.fsize;
						var hash = data.hash;
						var mimeType = data.mimeType;
						var putTime = data.putTime;
						formInfo.html("<ol><li>fsize: " + fsize + "</li><li>hash: " + hash + "</li><li>mimeType: " + mimeType + "</li><li>putTime: " + putTime + "</li></ol>");
						formInfo.show();
						formError.hide();
					} else {
						var err = error.Err;
						var reqId = error.Reqid;
						var details = error.Details;
						var code = error.Code;
						formError.html("<ol><li>Err: " + err + "</li><li>Reqid: " + reqId + "</li><li>Details: " + details + "</li><li>Code: " + code + "</li></ol>");
						formError.show();
						formInfo.hide();
					}
				}
			}, "json");
		});
	}); 
</script>
<?php
require ("../../footer.php");
?>