<?php
$video = $_GET['video'];

//$api_url = "http://gdata.youtube.com/feeds/api/videos/".$video."?v=2&alt=jsonc";
$api_url = 'https://www.googleapis.com/youtube/v3/videos?id='.$video.'&part=snippet&key=AIzaSyBGqRJzCgT1X0NoJrMx4axuwWC7ci0JyIQ';
$data = json_decode(http_parse_message(http_get($api_url))->body);
header('Location: ' . $data->items->snippet->thumbnails->default->url);
?>


