<?php
$video = $_GET['video'];

$api_url = "https://api.dailymotion.com/video/".$video."?fields=thumbnail_medium_url";
$data = json_decode(http_parse_message(http_get($api_url))->body);
header('Location: ' . $data->thumbnail_medium_url);
?>

