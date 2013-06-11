<?php

//getYoutubeImage($_GET["y"]);
$v = $_POST['v'];
getVideoContent($v);
function getVideoContent($v){
    //GET THE URL
//    $url = $e;
//    $queryString = parse_url($url, PHP_URL_QUERY);
//    parse_str($queryString, $params);
//    $v = $params['v'];
//    $v = _get_video_id($url);
    // get video ID from $_GET
    if (!isset($v)) {
        echo '<script>alert("ERROR: Missing video ID")</script>';
    } else {
        $vid = $v;
    }
    
    // set video data feed URL
    $feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $v;
    // read feed into SimpleXML object
    $entry = simplexml_load_file($feedURL);
    // parse video entry
    $video = parseVideoEntry($entry);

    // display video image, title and duration
//     echo "<img src='http://i3.ytimg.com/vi/$v/default.jpg' width='150' />";
    // echo "<p>{$video->title}</p>";
//     echo "<p>".sprintf("%0.2f", $video->length/60) . " min. </p>";
//     echo "<p>".customizeTime($video->length) . " min. </p>";
    echo json_encode($video);
}

// function to parse a video <entry>
function parseVideoEntry($entry) {
    $obj= new stdClass;

    // get nodes in media: namespace for media information
    $media = $entry->children('http://search.yahoo.com/mrss/');
    $obj->title = $media->group->title;
    $obj->description = $media->group->description;



    // get <yt:duration> node for video length
    $yt = $media->children('http://gdata.youtube.com/schemas/2007');
    $attrs = $yt->duration->attributes();
    $obj->length = $attrs['seconds'];

//     echo '<script>alert("'.$obj->title.'")</script>';
    // return object to caller
    return $obj;
}

function customizeTime($t){
    // var time = parseInt(Math.round(t));
    $minute = ''; 
    $second = '';
    $m = parseInt($t/60);
    $s = parseInt($t%60);
//    echo '<script>alert("'.$t.'--'.$m.'--'.$s.'")</script>';
    if($m == 0)
        $minute = "00";
    else if(m <10)
        $minute = "0" . $m;
    else
        $minute = $m;
    if($s == 0)
        $second = "00";
    else if($s < 10)
        $second = "0" . $s;
    else 
        $second = $s;
    return $minute . ":" . $second;
}
function parseInt($string) {
//	return intval($string);
    if(preg_match('/(\d+)/', $string, $array)) {
            return $array[1];
    } else {
            return 0;
    }
}


function _get_video_id($url) {
    if( preg_match( '/http:\/\/youtu.be/', $url, $matches) ) {
        $url = parse_url($url, PHP_URL_PATH);
        $url = str_replace( '/', '',  $url);
        return $url;
 
    } elseif ( preg_match( '/watch/', $url, $matches) ) {
        $arr = parse_url($url);
        $url = str_replace( 'v=', '', $arr['query'] );
        return $url;
 
    } elseif ( preg_match( '/http:\/\/www.youtube.com\/v/', $url, $matches) ) {
        $arr = parse_url($url);
        $url = str_replace( '/v/', '', $arr['path'] );
        return $url;
 
    } elseif ( preg_match( '/http:\/\/www.youtube.com\/embed/', $url, $matches) ) {
        $arr = parse_url($url);
        $url = str_replace( '/embed/', '', $arr['path'] );
        return $url;
 
    } elseif ( preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $url, $matches) ) {
        return $matches[0];
 
    } else {
        return false;
    }
}
?>