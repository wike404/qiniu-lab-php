<?php
require_once("../../lib/qiniu/auth_digest.php");
function create_public_resource_url($domain, $key)
{
    return $domain . "/" . $key;
}

function create_public_download_url($domain, $key, $save_file_name = NULL)
{
    $encoded_save_file_name = "";
    if (isset($save_file_name) && !empty($save_file_name)) {
        $encoded_save_file_name = urlencode($save_file_name);
    }
    return $domain . "/" . $key . "?attname=" . $encoded_save_file_name;
}

function create_private_resource_url($mac, $domain, $key, $expired_in_seconds)
{
    $deadline = time() + $expired_in_seconds;
    $base_url = $domain . "/" . $key . "?e=" . $deadline;
    $signedToken = Qiniu_Sign($mac, $base_url);
    $new_url = $base_url . "&token=" . $signedToken;
    return $new_url;
}

function create_private_download_url($mac, $domain, $key, $expired_in_seconds, $save_file_name = NULL)
{
    $deadline = time() + $expired_in_seconds;
    $encoded_save_file_name = "";
    if (isset($save_file_name) && !empty($save_file_name)) {
        $encoded_save_file_name = urlencode($save_file_name);
    }
    $base_url = $domain . "/" . $key . "?attname=" . $encoded_save_file_name . "&e=" . $deadline;
    $signedToken = Qiniu_Sign($mac, $base_url);
    $new_url = $base_url . "&token=" . $signedToken;
    return $new_url;
}

$public_bucket_domain = "http://7pn64c.com1.z0.glb.clouddn.com";
$private_bucket_domain = "http://7qnctm.com1.z0.glb.clouddn.com";
$public_file_key = "bdlogo.png";
$private_file_key = "qiniu.jpg";

$public_resource_url = create_public_resource_url($public_bucket_domain, $public_file_key);
$public_download_url = create_public_download_url($public_bucket_domain, $public_file_key, "百度logo.png");

$access_key = "ELUs327kxVPJrGCXqWae9yioc0xYZyrIpbM6Wh6o";
$secret_key = "LVzZY2SqOQ_I_kM1n00ygACVBArDvOWtiLkDtKi_";
$mac = new Qiniu_Mac($access_key, $secret_key);
$private_resource_url = create_private_resource_url($mac, $private_bucket_domain, $private_file_key, 3600);
$private_download_url = create_private_download_url($mac, $private_bucket_domain, $private_file_key, 3600, "七牛logo.jpg");

print($public_resource_url."\r\n");
print($public_download_url."\r\n");
print($private_resource_url."\r\n");
print($private_download_url."\r\n");