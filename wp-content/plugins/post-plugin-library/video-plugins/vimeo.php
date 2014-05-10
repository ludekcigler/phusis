<?php
$video = $_GET['video'];

$api_url = "http://vimeo.com/api/v2/video/".$video.".json";
$data = json_decode(http_parse_message(http_get($api_url))->body);

header('Location: ' . $data[0]->thumbnail_medium);
?>
