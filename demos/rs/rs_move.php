<?php
$PAGE_TITLE = "Move 将源空间的指定资源移动到目标空间，或在同一空间内对资源重命名。";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>

<p class="title">
	将源空间的指定资源移动到目标空间，或在同一空间内对资源重命名。
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		将源空间的指定资源移动到目标空间，或在同一空间内对资源重命名。具体细节参考<a href="http://developer.qiniu.com/docs/v6/api/reference/rs/move.html">文档</a>。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form method="post" action="<?php echo $APP_ROOT; ?>/demos/rs/rs_move_action.php"
		role="form" id="rs-move-form">
			<div class="form-group">
				<input name="srcBucket" value="" placeholder="请指定源空间名称" class="form-control"/>
			</div>
			<div class="form-group">
				<input name="srcKey" value="" placeholder="请指定源文件的key" class="form-control"/>
			</div>
			<div class="form-group">
				<input name="destBucket" value="" placeholder="请指定目标空间名称" class="form-control"/>
			</div>
			<div class="form-group">
				<input name="destKey" value="" placeholder="请指定目标文件的key" class="form-control"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Move" class="btn btn-info"/>
			</div>
		</form>
		<p class="alert alert-danger" id="form-error" style="display: none;"></p>
		<p class="alert alert-info" id="form-info" style="display: none;"></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var rsMoveForm = $("#rs-move-form");
		var formError = $("#form-error");
		var formInfo = $("#form-info");
		rsMoveForm.submit(function(event) {
			event.preventDefault();
			var actionUrl = rsMoveForm.attr("action");
			var srcBucket = rsMoveForm.find("input[name='srcBucket']")[0].value;
			var srcKey = rsMoveForm.find("input[name='srcKey']")[0].value;
			var destBucket = rsMoveForm.find("input[name='destBucket']")[0].value;
			var destKey = rsMoveForm.find("input[name='destKey']")[0].value;
			$.post(actionUrl, {
				srcBucket : srcBucket,
				srcKey : srcKey,
				destBucket : destBucket,
				destKey : destKey
			}, function(respData) {
				var error = respData.error;
				if (error != undefined) {
					formError.text(error);
					formError.show();
					formInfo.hide();
				} else {
					var data = respData[0];
					var error = respData[1];
					if (error != null) {
						var err = error.Err;
						var reqId = error.Reqid;
						var details = error.Details;
						var code = error.Code;
						formError.html("<ol><li>Err: " + err + "</li><li>Reqid: " + reqId + "</li><li>Details: " + details + "</li><li>Code: " + code + "</li></ol>");
						formError.show();
						formInfo.hide();
					} else {
						formInfo.html("operation done!");
						formInfo.show();
						formError.hide();
					}
				}
			}, "json");
		});
	}); 
</script>
<?php
require ("../../footer.php");
?>