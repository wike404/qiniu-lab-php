<?php require("header.php"); ?>
<?php
if (isset($_POST["accessKey"])) {
    $_SESSION["Qiniu_AccessKey"] = trim($_POST["accessKey"]);
}
if (isset($_POST["secretKey"])) {
    $_SESSION["Qiniu_SecretKey"] = trim($_POST["secretKey"]);
}
if (isset($_POST["publicBucket"])) {
    $_SESSION["Qiniu_PublicBucket"] = trim($_POST["publicBucket"]);
}
if (isset($_POST["privateBucket"])) {
    $_SESSION["Qiniu_PrivateBucket"] = trim($_POST["privateBucket"]);
}
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            全局设置
        </div>
        <div class="panel-body">
            <form method="post" action="" role="form">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">AccessKey</span>
                        <input name="accessKey" type="text" value="<?php
                        if (isset($_SESSION["Qiniu_AccessKey"])) {
                            echo $_SESSION["Qiniu_AccessKey"];
                        }
                        ?>"
                               class="form-control"
                            />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">SecretKey</span>
                        <input name="secretKey" type="text" value="<?php
                        if (isset($_SESSION["Qiniu_SecretKey"])) {
                            echo $_SESSION["Qiniu_SecretKey"];
                        }
                        ?>"
                               class="form-control"
                            />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">公开空间</span>
                        <input name="publicBucket" type="text"
                               value="<?php
                               if (isset($_SESSION["Qiniu_PublicBucket"])) {
                                   echo $_SESSION["Qiniu_PublicBucket"];
                               }
                               ?>"
                               class="form-control"
                            />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">私有空间</span>
                        <input name="privateBucket" type="text"
                               value="<?php
                               if (isset($_SESSION["Qiniu_PrivateBucket"])) {
                                   echo $_SESSION["Qiniu_PrivateBucket"];
                               }
                               ?>"
                               class="form-control"
                            />
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="设置" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

<?php require("footer.php"); ?>