<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/userBll.php';
include '../BLL/activityHistoryBLL.php';
include '../BLL/articleBLL.php';
$flag = $_POST['flag'];
$userid = $_SESSION['userid'];

if($flag == 'getDataUserFollow'){
    $followList = null;
    $friends_UserFollow = getAllFriend_UserFollow($userid);
    $index = 0;
    for($i = 0; $i < count($friends_UserFollow); $i++){
        $friendFollowId = $friends_UserFollow[$i]->FollowId;
        $activityListByFriendFollow = getActivityHistoryByUserId($friendFollowId);
        for($j = 0; $j < count($activityListByFriendFollow); $j++){
            $followItem = new FollowItem();
            $activity = $activityListByFriendFollow[$j];
            $article = getArticleById($activity->articleid);
            $followItem->friendFollowid = $friendFollowId;
            $followItem->articleid = $activity->articleid;
            $followItem->avatar = getInforUserById($friendFollowId)->avatar;
            $followItem->name = getInforUserById($friendFollowId)->name;
            $followItem->title = $article->title;
            $followItem->datesubmit = $activity->datesubmit;
//            echo "<script>alert('".date_format(new DateTime($followItem->datesubmit), 'd/m/Y H:i A')."')</script>";
            $followList[$index] = $followItem;
            $index++;
        }
    }

    $contactList = "";
    for($i = 0; $i < count($followList); $i++){
        $item = $followList[$i];
        $itemHTML = '<li id='.$item->friendFollowid.'  title="'.$item->title.'" class="contact-item "><a href="play.php?id='.$item->articleid.'" target="_blank"><div class="contact-avt" style="background-image:url('.$item->avatar.')"></div>
        <div class="contact-info"><div class="contact-info-head"><span class="contact-name">'.$item->name.'</span>
        <span class="contact-time">'.date_format(new DateTime($item->datesubmit), 'd/m/Y H:i A').'</span></div>
        <span id='.$item->articleid.' class="contact-message">'.$item->title.'</span></div></a></li>';
        $contactList = $contactList . $itemHTML;
    }
    echo $contactList;
}


function getAllFriend_UserFollow ($userid) {
    $sql = "select * from tbl_followuser where userid = '".$userid."'";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new FollowList();
        $item->UserId = $seletedItem['userid'];
        $item->FollowId = $seletedItem['followid'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}


?>