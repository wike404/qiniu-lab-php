<?php
header("Content-Type: application/json; charset=utf-8");
$playlist = array(
    array("name" => "Go Time (mp3)", "url"=>"http://7rf353.com1.z0.glb.clouddn.com/gotime.mp3",),
    array("name"=>"Go Time (m3u8)","url"=>"http://7rf353.com1.z0.glb.clouddn.com/gotime.m3u8"),
    array("name" => "七牛视频名片 (mp4)", "url" => "http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.mp4",),
    array("name"=>"七牛视频名片 (m3u8)","url"=>"http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.m3u8"),
);
$respData = array(
    "playlist" => $playlist
);
echo json_encode($respData);