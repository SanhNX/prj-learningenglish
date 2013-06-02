<?php
session_start();
include '../DAO/connection.php';
include '../BLL/activityHistoryBLL.php';

$userid = 1;
$now = getdate();
$datesubmit = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];

$excuteQuery = addActivityHistory($userid, $_POST['articleid'], $datesubmit, $_POST['score']);
if ($excuteQuery == -1) {
    echo 'false';
} else {
    echo 'true';
}
?>

