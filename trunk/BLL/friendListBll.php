<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/userBll.php';
$flag = $_POST['flag'];
$userid = $_SESSION['userid'];
$now = getdate();
$date = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"] . " " . ($now["hours"] + 1) . ":" . $now["minutes"] . ":" . $now["seconds"];
if($flag == 'getAllFriend'){
    $friendList = getAllFriendListFromUser($userid);
    $friendListHTML = "";
    for ($i = 0; $i < count($friendList); $i++) {
        $item = $friendList[$i];
        $user = getInforUserById($item->FriendId);
        $friendItem = '<li id="'.$user->id.'" class="friend-item" title='.$user->name.'><div class="friend-avt" style="background-image: url('.$user->avatar.')"></div><span class="friend-name">'.$user->name.'</span><input id="id'.$user->id.'" type="hidden" value="'.$user->id.'"></li>';
        $friendListHTML = $friendListHTML . $friendItem;
    }
    echo $friendListHTML;
}

if($flag == 'followUser'){
    $followid = $_POST['followid'];
    $excuteQuery = addFollowUser($userid, $followid);
    if($excuteQuery == -1)
        echo 'fail';
    else
        echo 'success';
}

if($flag == 'addFriend'){
    $friendid = $_POST['friendid'];
    $excuteQuery = addFriend($userid, $friendid, $date);
    if($excuteQuery == -1)
        echo 'fail';
    else
        echo 'success';
}


function getAllFriendListFromUser ($userid) {
    $sql = "select * from tbl_friendlist where userid = '".$userid."' ORDER BY dateaccept DESC";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new FriendList();
        $item->friendListId = $seletedItem['friendlistid'];
        $item->UserId = $seletedItem['userid'];
        $item->FriendId = $seletedItem['friendid'];
        $item->Dateaccept = $seletedItem['dateaccept'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function addFollowUser ($userid, $followid){
    $sql = "INSERT INTO tbl_followuser (userid, followid) VALUES ('$userid','$followid')";
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

function addFriend ($userid, $friendid, $dateaccept){
    $sql = "INSERT INTO tbl_friendlist (userid, friendid, dateaccept) VALUES ('$userid','$friendid', '$dateaccept')";
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

?>