<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/userBll.php';
$flag = $_POST['flag'];
$userid = $_SESSION['userid'];

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

?>