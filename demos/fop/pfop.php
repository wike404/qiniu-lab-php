<?php
$PAGE_TITLE = "资源管理－触发持久化";
require_once ("../../header.php");
require_once ("../../lib/qiniu/auth_digest.php");
?>
<div class="title">
	资源管理－触发持久化
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		实验
	</div>
	<div class="panel-body">
		<form action="<?php echo $APP_ROOT; ?>/demos/fop/pfop_action.php" method="POST" role="form" id="pfop-form">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Bucket</span>
					<input name="bucket" type="text" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Key</span>
					<input name="key" type="text" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Fops</span>
					<input name="fops" type="text" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Notify URL</span>
					<input name="notifyURL" type="text" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Force</span>
					<select name="force" class="form-control">
						<option value="0">0</option>
						<option value="1">1</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Pipeline</span>
					<input name="pipeline" type="text" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" value="Pfop Operation" class="btn btn-primary"/>
			</div>
			<div class="alert alert-danger" id="form-error" style="display:none;">

			</div>
		</form>

		<form action="http://api.qiniu.com/status/get/prefop" method="GET">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">PersistentId</span>
					<input name="id" type="text" class="form-control" id="persistentId"/>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" value="Get Prefop Status" class="btn btn-info"/>
			</div>
		</form>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var pfopForm = $("#pfop-form");
		var formError = $("#form-error");
		var formInfo = $("#form-info");
		var persistId = $("#persistentId");
		pfopForm.submit(function(event) {
			event.preventDefault();
			var bucket = $.trim(pfopForm.find("input[name='bucket']")[0].value);
			var key = $.trim(pfopForm.find("input[name='key']")[0].value);
			var fops = $.trim(pfopForm.find("input[name='fops']")[0].value);
			var notifyURL = $.trim(pfopForm.find("input[name='notifyURL']")[0].value);
			var force = $.trim(pfopForm.find("select[name='force']")[0].value);
			var pipeline = $.trim(pfopForm.find("input[name='pipeline']")[0].value);
			var actionUrl = $.trim(pfopForm.attr("action"));
			$.post(actionUrl, {
				bucket : bucket,
				key : key,
				fops : fops,
				notifyURL : notifyURL,
				force : force,
				pipeline : pipeline
			}, function(respData) {
				var error = respData[1];
				if (error != null) {
					var err = error["Err"];
					var reqId = error["Reqid"];
					var details = error["Details"];
					var code = error["Code"];
					formInfo.hide();
					formError.html("<ol><li>Err:" + err + "</li><li>Reqid:" + reqId + "</li><li>Details:" + details + "</li><li>Code:" + code + "</li><ol>");
					formError.show();
				} else {
					var data = respData[0];
					var persistentId = data["persistentId"];
					persistId.val(persistentId);
				}
			}, "json");
		});
	}); 
</script>

<?php
require_once ("../../footer.php");
?>