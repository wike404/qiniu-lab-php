<?php
$PAGE_TITLE = "常见错误列表";
?>
<?php
require("../../header.php");
?>

    <div>
        <div class="row">
            <div class="col-md-6">
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
                <div class="panel panel-default">
                    <p class="panel-heading">
                        {"error":"key does not match the scope"}
                    </p>

                    <p class="panel-body">
                        上传策略里面Scope参数应该为空间名字，而不是空间域名。
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php
require("../../footer.php");
?>