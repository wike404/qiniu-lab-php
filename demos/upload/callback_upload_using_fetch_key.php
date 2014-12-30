<?php
$PAGE_TITLE = "CallbackFetchKey-以回调方式获取上传文件名";
?>
<?php
require("../../header.php");
?>
<?php
require("../../qiniu_config.php");
?>
<?php
require_once("../../lib/qiniu/rs.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->CallbackUrl = $APP_CALLBACK_ROOT . "/demos/service/callback_upload_fetch_key_service.php";
$callbackBody = array("fname" => "$(fname)", "etag" => "$(etag)", "exParam1" => "$(x:exParam1)", "exParam2" => "$(x:exParam2)", "exParam3" => "$(x:exParam3)");
$callbackBody = json_encode($callbackBody);
//your own server will get the callbackbody posted by qiniu server with a content-type of application/json
$putPolicy->CallbackBodyType = "application/json";
$putPolicy->CallbackBody = $callbackBody;
$putPolicy->CallbackFetchKey = 1;
$token = $putPolicy->Token(null);
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            实验
        </div>
        <div class="panel-body">
            <form method="post" action="http://upload.qiniu.com" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Token</span>
                        <input name="token" type="text" value="<?php echo $token; ?>"
                               class="form-control" readonly="true"
                            />
                    </div>
                </div>
                <div class="form-group">
                    <input name="x:exParam1" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
                </div>
                <div class="form-group">
                    <input name="x:exParam2" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
                </div>
                <div class="form-group">
                    <input name="x:exParam3" type="text" value="" class="form-control" placeholder="请设置扩展参数的值"/>
                </div>
                <div class="form-group">
                    <input name="file" type="file"/>
                </div>
                <div class="form-group">
                    <input type="submit" value="Upload" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

<?php
require("../../footer.php");
?>