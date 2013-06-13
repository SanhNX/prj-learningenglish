<?php
include '../DAO/connection.php';

$idvideo = $_POST['v'];
$cateid = $_POST['cateid'];
$title = $_POST['title'];
$link = 'http://www.youtube.com/embed/'.$idvideo;
$thumbnail = 'http://img.youtube.com/vi/'.$idvideo.'/mqdefault.jpg';
$duration = $_POST['duration'];
$level = $_POST['level'];
$now = getdate();
$datecreate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];

$isExists = checkExistYTID($idvideo);
if($isExists == -1){
    $articleid = insertArticle($idvideo, $cateid, $title, $link, $thumbnail, $duration, $level, $datecreate);

    if ($articleid == -1) {
        echo 'false';
    } else {
        $file = fopen("../data-video/".$articleid.".json","w+") or exit("Unable to open file!");
        $content = str_replace("readonly='true'", "", $_POST['content']);
        $content = str_replace("value='true'", "", $content);

        fwrite($file,$content);
        fclose($file);
        echo 'true';
    }
} else {
    echo 'false';
}

function insertArticle ($idvideo, $cateid, $title, $link, $thumbnail, $duration, $level, $datecreate){
    $sql = "INSERT INTO tbl_article
                (idvideo, categoryid, title, link, thumbnail, duration, level, timesplay, datecreate)
                VALUES ('$idvideo','$cateid', '$title', '$link', '$thumbnail', '$duration', '$level', '0', '$datecreate')";
    $queryResult = mysql_query($sql) or die(mysql_error());

    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }

    if ($queryResult)
        return mysql_insert_id();
    else
        return -1;
}

function checkExistYTID($ytid) {
    $sql = "SELECT * FROM tbl_article Where idvideo = '".$ytid."'";
    $queryResult = mysql_query($sql);

    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }

    if (mysql_num_rows($queryResult) > 0){
        return  1;
    }
    else
        return -1;
}
?>