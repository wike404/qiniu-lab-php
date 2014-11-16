<?php
$PAGE_TITLE = "Unix时间戳转换";
?>
<?php
require ("../header.php");
?>
<?php
date_default_timezone_set('Asia/Shanghai');
if (isset($_POST["timestampInSeconds"])) {
	$timestampInSeconds = $_POST["timestampInSeconds"];
	$timeStrFromSeconds = date('r', $timestampInSeconds);
}
if(isset($_POST["timestampInNanoSeconds"]))
{
	$timestampInNanoSeconds=$_POST["timestampInNanoSeconds"];
	$timeStrFromNanoSeconds=date('r',$timestampInNanoSeconds/10000000);
}
?>
<div class="title">
	Unix时间戳转换
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Unix 时间戳（秒） -> 时间
			</div>
			<div class="panel-body">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<textarea name="timestampInSeconds" class="form-control"><?php
						if (isset($timestampInSeconds)) {echo $timestampInSeconds;
						}
 ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Convert" class="form-control btn btn-primary"/>
					</div>
				</form>
				<textarea class="form-control" readonly="true"><?php
				if (isset($timeStrFromSeconds)) { echo $timeStrFromSeconds;
				}
				?></textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Unix 时间戳（100纳秒） -> 时间
			</div>
			<div class="panel-body">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<textarea name="timestampInNanoSeconds" class="form-control"><?php
						if (isset($timestampInNanoSeconds)) {echo $timestampInNanoSeconds;
						}
 ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Convert" class="form-control btn btn-primary"/>
					</div>
				</form>
				<textarea class="form-control" readonly="true"><?php
				if (isset($timeStrFromNanoSeconds)) { echo $timeStrFromNanoSeconds;
				}
				?></textarea>
			</div>
		</div>
	</div>
</div>

<?php
require ("../footer.php");
?>