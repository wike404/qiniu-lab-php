<?php
$PAGE_TITLE = "常见错误列表";
?>
<?php
require ("../../header.php");
?>

<div>
	<div class="panel panel-default">
		<p class="panel-heading">
			{"error":"file is not specified in multipart"}
		</p>
		<p class="panel-body">
			上传文件请求中没有指定文件错误
		</p>
	</div>
	<div class="panel panel-default">
		<p class="panel-heading">
			{"error":"expired token"}
		</p>
		<p class="panel-body">
			Token过期，重新生成新的Token使用
		</p>
	</div>
</div>

<?php
require ("../../footer.php");
?>