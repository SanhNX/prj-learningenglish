<?php

session_start();
include '../DAO/connection.php';
include '../BLL/activityHistoryBLL.php';
include '../BLL/articleBll.php';

$userid = $_SESSION['userid'];
$now = getdate();
$datesubmit = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];

$excuteQuery = addActivityHistory($userid, $_POST['articleid'], $datesubmit, $_POST['score']);
if ($excuteQuery == -1) {
    echo 'false';
} else {
    // update timesplay for tbl_article
    $isEdit = updateArticle($_POST['articleid']);
    if ($isEdit != 1)
        echo 'false';
    else
        echo 'true';
}
?>

