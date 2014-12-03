<?php
header("Content-Type: application/json; charset=utf-8");
$playlist = array(
    array("name" => "sea", "url" => "http://qiniu-lab.qiniudn.com/sea.mp4"),
    array("name" => "fun", "url" => "http://qiniu-lab.qiniudn.com/aaa.mp4",),
    array("name" => "rat爱厨艺", "url" => "http://qiniu-lab.qiniudn.com/rat.mp4"),
    array("name" => "qiniu视频名片", "url" => "http://qiniu-lab.qiniudn.com/see.mp4",)
);
$respData = array(
    "playlist" => $playlist
);
echo json_encode($respData);