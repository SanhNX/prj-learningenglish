<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

if ($_FILES["file"]["name"] == '')
    $avatar = 'images/icon/avata-ico.png';
else
    $avatar = "images/resource/" . $_FILES["file"]["name"];
// Các xử lý để chèn vào Database!
$now = getdate();
$currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];

//echo '<script>alert("'.$_POST['fname'].'---'.$_POST['email'].'--'. $_POST['pass'].'--'. $currentDate.'--'. $_POST['gender'].'--'. $avatar.'");</script>';
$excuteQuery = insertUser($_POST['fname'], $_POST['email'], $_POST['pass'], $currentDate, $_POST['gender'], $avatar);
if ($excuteQuery == -1) {
    echo 'false';
} else {
    $dirTemp = str_replace('BLL', '', getcwd()) . "images/resource/";
//    echo '<script>alert("'.$dirTemp.'");</script>';
    $dir = str_replace("\\", "/", $dirTemp . $_FILES["file"]["name"]);
//    echo '<script>alert("'.$dir.'");</script>';
    move_uploaded_file($_FILES["file"]["tmp_name"], $dir);
//    echo '<script>alert("'.$dir.'");</script>';
    echo 'true';
}

