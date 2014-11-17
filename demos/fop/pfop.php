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
					<textarea name="fops" type="text" class="form-control"></textarea>
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
			<div class="alert alert-danger" id="pfop-form-error" style="display:none;">

			</div>
		</form>
		<form action="<?php echo $APP_ROOT; ?>/demos/fop/prefop_query_action.php" method="GET" id="prefop-form">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">PersistentId</span>
					<input name="persistentId" type="text" class="form-control" id="persistentId"/>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" value="Get Prefop Status" class="btn btn-info"/>
			</div>
			<div class="alert alert-info" id="prefop-form-info" style="display:none;">

			</div>
			<div class="alert alert-danger" id="prefop-form-error" style="display: none;">

			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//submit the fop operation request
		var pfopForm = $("#pfop-form");
		var pfopFormError = $("#pfop-form-error");
		var persistId = $("#persistentId");
		pfopForm.submit(function(event) {
			event.preventDefault();
			persistId.val("");
			var bucket = $.trim(pfopForm.find("input[name='bucket']")[0].value);
			var key = $.trim(pfopForm.find("input[name='key']")[0].value);
			var fops = $.trim(pfopForm.find("textarea[name='fops']")[0].value);
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

		//query the fop operation status
		var prefopForm = $("#prefop-form");
		var prefopFormInfo = $("#prefop-form-info");
		var prefopFormError = $("#prefop-form-error");
		prefopForm.submit(function(event) {
			event.preventDefault();
			var persistentId = prefopForm.find("input[name='persistentId']")[0].value;
			var actionUrl = prefopForm.attr("action");
			$.post(actionUrl, {
				persistentId : persistentId
			}, function(respData) {
				var error = respData.error;
				if (error != null) {
					prefopFormInfo.hide();
					prefopFormError.text(error);
					prefopFormError.show();
				} else {
					var fopStatusData = respData[0];
					var fopStatusError = respData[1];
					if (fopStatusData != null) {
						var id = fopStatusData["id"];
						var code = fopStatusData["code"];
						var desc = fopStatusData["desc"];
						var inputKey = fopStatusData["inputKey"];
						var pipeline = fopStatusData["pipeline"];
						var reqId = fopStatusData["reqid"];
						var items = fopStatusData["items"];
						prefopFormError.hide();
						var htmlBody = "<ol><li>Id:" + id + "</li><li>Code:" + code + "</li><li>Desc:" + desc + "</li><li>InputKey:" + inputKey + "</li><li>Pipeline:" + pipeline + "</li><li>Reqid:" + reqId + "</li></ol>";
						htmlBody+="<table class='pfop-result-table'><tr><th>Cmd</th><th>Code</th><th>Desc</th><th>Key</th></tr>";
						for(var index in items)
						{
							var item=items[index];
							var cmd=item["cmd"];
							var code=item["code"];
							var desc=item["desc"];
							var key=item["key"];
							htmlBody+="<tr><td>"+cmd+"</td><td>"+code+"</td><td>"+desc+"</td><td>"+key+"</td></tr>";
						}
						htmlBody+="</table>";
						prefopFormInfo.html(htmlBody);
						prefopFormInfo.show();
					} else {
						var err = fopStatusError["Err"];
						var reqId = fopStatusError["Reqid"];
						var details = fopStatusError["Details"];
						var code = fopStatusError["Code"];
						prefopFormInfo.hide();
						prefopFormError.html("<ol><li>Err:" + err + "</li><li>Reqid:" + reqId + "</li><li>Details:" + details + "</li><li>Code:" + code + "</li><ol>");
						prefopFormError.show();
					}
				}
			}, "json");
		});
	}); 
</script>

<?php
require_once ("../../footer.php");
?>