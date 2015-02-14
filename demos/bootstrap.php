<?php
error_reporting(E_ERROR);
function __autoload($class_name)
{
    if (strstr($class_name, "Qiniu") === false) {
        return;
    }
    $class_name = str_replace("\\", "/", $class_name);
    require_once __DIR__ . "/../library/" . $class_name . ".php";
}

require_once __DIR__ . "/../library/Qiniu/functions.php";

$QINIU_ACCESS_KEY = "aGUmGfTmXycYQ1FxFnULfCJe0hw-bJiD3hZpgHgY";
$QINIU_SECRET_KEY = "ys6ztcrbTvQDNljzj4uxKTTyUzc_XI8Hbfcskyho";
$QINIU_PUBLIC_BUCKET = "if-pbl";
$QINIU_PRIVATE_BUCKET = "if-pri";