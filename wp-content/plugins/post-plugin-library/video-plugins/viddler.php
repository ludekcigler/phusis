<?php
$video = $_GET['video'];

$api_url = "http://api.viddler.com/api/v2/viddler.videos.getDetails.json?key=nkskvc9ev4xkcpf695th&video_id=".$video;
$data = json_decode(http_parse_message(http_get($api_url))->body);

header('Location: ' . $data->video->thumbnail_url);
?>

