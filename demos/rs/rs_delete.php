<?php
$PAGE_TITLE = "Delete 删除指定空间的资源";
?>
<?php
require ("../../header.php");
?>
<?php
require ("../../qiniu_config.php");
?>

<p class="title">
	Delete 删除指定空间的资源
</p>
<div class="panel panel-default">
	<div class="panel-heading">
		目的
	</div>
	<div class="panel-body">
		该实验演示如何删除一个空间中的文件。具体细节参考<a href="http://developer.qiniu.com/docs/v6/api/reference/rs/delete.html">文档</a>。
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form method="post" action="<?php echo $APP_ROOT; ?>/demos/rs/rs_delete_action.php"
		role="form" id="rs-delete-form">
			<div class="form-group">
				<input name="bucket" value="" placeholder="请指定空间名称" class="form-control"/>
			</div>
			<div class="form-group">
				<input name="key" value="" placeholder="请指定文件的key" class="form-control"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Delete" class="btn btn-info"/>
			</div>
		</form>
		<p class="alert alert-danger" id="form-error" style="display: none;"></p>
		<p class="alert alert-info" id="form-info" style="display: none;"></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var rsDeleteForm = $("#rs-delete-form");
		var formError = $("#form-error");
		var formInfo = $("#form-info");
		rsDeleteForm.submit(function() {
			event.preventDefault();
			var actionUrl = rsDeleteForm.attr("action");
			var bucket = rsDeleteForm.find("input[name='bucket']")[0].value;
			var key = rsDeleteForm.find("input[name='key']")[0].value;
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