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

$QINIU_ACCESS_KEY = "TQt-iplt8zbK3LEHMjNYyhh6PzxkbelZFRMl10MM";
$QINIU_SECRET_KEY = "hTIq4H8N5NfCme8gDvZqr6EDmvlIQsRV5L65bVce";
$QINIU_PUBLIC_BUCKET = "if-pbl";
$QINIU_PRIVATE_BUCKET = "if-pri";