<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

$now = getdate();
$currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];

$usingfb = $_POST['usingfb'];
//echo '<script>alert("'.$usingfb.'");</script>';
if($usingfb == 'true') {
    $avatar = $_POST['avatar'];
    $fbid = $_POST['fbid'];
    $isExistFBID = checkExistFBID($fbid);
    if ($isExistFBID == -1) {
        $excuteQuery = insertUser($_POST['fname'], $_POST['email'], $_POST['pass'], $currentDate, $_POST['gender'], $avatar, $fbid);
        if ($excuteQuery == -1) {
            echo $excuteQuery;
        } else {
            $fb_id = checkExistFBID($fbid);
            echo $fb_id;
        }
    } else {
        echo $isExistFBID;
    }
} else {
    if ($_FILES["file"]["name"] == '')
        $avatar = 'images/icon/avata-ico.png';
    else
        $avatar = "images/resource/" . $_FILES["file"]["name"];
    $excuteQuery = insertUser($_POST['fname'], $_POST['email'], $_POST['pass'], $currentDate, $_POST['gender'], $avatar, '');
    if ($excuteQuery == -1) {
        echo 'false';
    } else {
        $dirTemp = str_replace('BLL', '', getcwd()) . "images/resource/";
        $dir = str_replace("\\", "/", $dirTemp . $_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $dir);
        echo 'true';
    }
}


//echo '<script>alert("'.$_POST['fname'].'---'.$_POST['email'].'--'. $_POST['pass'].'--'. $currentDate.'--'. $_POST['gender'].'--'. $avatar.'");</script>';


