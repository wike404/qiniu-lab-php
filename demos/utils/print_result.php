<?php
function QiniuLab_PrintResult($ret, $err)
{
    print_r($err);
    if ($err) {
        print("Err: " . $err->Err . "\r\n");
        print("Reqid: " . $err->Reqid . "\r\n");
        print("Details: " . $err->Details . "\r\n");
        print("Code: " . $err->Code . "\r\n");
    } else if ($ret) {
        foreach ($ret as $key => $val) {
            print($key . ": " . $val . "\r\n");
        }
    } else {
        print("Done!\r\n");
    }
    print("\r\n");
}