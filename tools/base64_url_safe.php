<?php
$PAGE_TITLE = "Url安全的Base64编码和解码";
require ("../header.php");
?>
<?php
require ("../lib/qiniu/utils.php");
if (isset($_POST["strToEncode"])) {
	$strToEncode = $_POST["strToEncode"];
	$strEncoded = "";
	$strEncoded = Qiniu_Encode($strToEncode);
}

if (isset($_POST["strToDecode"])) {
	$strToDecode = $_POST["strToDecode"];
	$strDecoded = "";
	$strDecoded = Qiniu_Decode($strToDecode);
}
?>
<div class="title">
	Url安全的Base64编码/解码，参考<a href="http://developer.qiniu.com/docs/v6/api/overview/appendix.html#urlsafe-base64">文档</a>。
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Url安全的Base64编码
			</div>
			<div class="panel-body">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<textarea name="strToEncode" class="form-control"><?php
						if (isset($strToEncode)) {echo $strToEncode;
						}
 ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Encode" class="form-control btn btn-primary"/>
					</div>
				</form>
				<textarea class="form-control" readonly="true"><?php
					if (isset($strEncoded)) { echo $strEncoded;
					}
				?></textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Url安全的Base64解码
			</div>
			<div class="panel-body">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<textarea name="strToDecode" class="form-control"><?php
						if (isset($strToDecode)) {echo $strToDecode;
						}
 ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Decode" class="form-control btn btn-info"/>
					</div>
				</form>
				<textarea class="form-control" readonly="true"><?php
					if (isset($strDecoded)) { echo $strDecoded;
					}
 ?></textarea>
			</div>
		</div>
	</div>
</div>

<?php
require ("../footer.php");
?>
