<?php
function QiniuLab_PrintResult($ret, $err)
{
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

function QiniuLab_PrintBatchStatResult($ret, $err)
{
    if ($err) {
        print("Err: " . $err->Err . "\r\n");
        print("Reqid: " . $err->Reqid . "\r\n");
        print("Details: " . $err->Details . "\r\n");
        print("Code: " . $err->Code . "\r\n");
        print("\r\n");
    }

    if ($ret) {
        foreach ($ret as $statResult) {
            $code = $statResult["code"];
            $data = $statResult["data"];
            if (isset($data["error"])) {
                print("Code: " . $code . ", Error: " . $data["error"] . "\r\n");
            } else {
                foreach ($data as $key => $val) {
                    print($key . ": " . $val . "\r\n");
                }
            }
            print("----------------------------------------\r\n");
        }
        print("\t\n");
    }
}