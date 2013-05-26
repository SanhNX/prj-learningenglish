<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

// Các xử lý để chèn vào Database!
$now = getdate();
$currentDate = $now["year"] . "-" . $now["mon"] . "-" . ($now["mday"] - 1);
//echo '<script>alert("'.$_POST['email'].'--'. $_POST['pass'].'--'. $currentDate.'--'. $_POST['gender'].'--'. $_POST['avatar'].'");</script>';
$excuteQuery = insertUser($_POST['email'], $_POST['pass'], $currentDate, $_POST['gender'], $_POST['avatar']);
if ($excuteQuery == -1) {
    echo 'false';
} else {
    echo 'true';
}

