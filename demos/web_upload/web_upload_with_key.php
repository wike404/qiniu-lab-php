<?php
$PAGE_TITLE = "简单网页文件上传－指定上传文件的key";
?>
<?php
require("../../header.php");
require_once("../../qiniu_download_config.php");
?>
<p class="title">
    简单网页上传-指定上传文件的key
</p>
<div class="panel panel-default">
    <div class="panel-heading">
        目的
    </div>
    <div class="panel-body">
        该实验的目的是演示上传时指定文件名，该文件名以form的参数提交，参数名称是key，七牛服务器将使用上传时指定的key的值来作为文件的名字。
        这个例子使用了qiniu的javascript的sdk，可以实现无网页刷新的上传。
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        实验
    </div>
    <div class="panel-body" id="wbu-container">
        <button class="btn btn-info" id="wbu1-select-f">选择一个文件</button>
    </div>
    <div class="panel-body">
        <p id="wbu-result" class="alert alert-info">

        </p>
    </div>
</div>
<?php
require("../../footer.php");
?>

<script type="text/javascript"
        src="<?php echo $APP_ROOT; ?>/public/plugin/plupload-2.1.2/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo $APP_ROOT; ?>/public/plugin/qiniu-1.0.3/qiniu.min.js"></script>

<!--更多参数请参考 https://github.com/qiniu/js-sdk -->
<script type="text/javascript">
    var wbuResult = $("#wbu-result");
    wbuResult.hide();
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'wbu1-select-f',
        domain: '<?php echo $Qiniu_Public_Bucket_Download_Domain;?>',
        uptoken_url: '<?php echo $APP_ROOT . "/demos/api/simple_upload_with_key_upload_token.php" ?>',
        container: 'wbu-container',
        max_file_size: '100mb',
        flash_swf_url: '../../public/plugin/plupload-2.1.2/Moxie.swf',
        max_retries: 3,
        dragdrop: true,
        drop_element: 'wbu-container',
        chunk_size: '4mb',
        auto_start: true,
        init: {
            'FileUploaded': function (up, file, info) {
                var ret = $.parseJSON(info);
                var key = ret.key;
                var hash = ret.hash;
                wbuResult.html("Key:" + key + "<br/> Hash:" + hash);
                wbuResult.show();
            }
        }

    });
</script>