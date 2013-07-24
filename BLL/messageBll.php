<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';

$userid = $_SESSION['userid'];
$friendid = 2;

$result = getAllMessageWithFriend($userid, $friendid);
$messageList = "";
$avt0 = "images/resource/avt0.jpg";
$avt5 = "images/resource/metro/m5.jpg";
for ($i = 0; $i < count($result); $i++) {
    $item = $result[$i];
    $messageItem = "";
    if($item->UserId == $userid){
        $messageItem = '<li class="message-item">
				<div class="message-avt" style="background-image: url('.$avt0.')"></div>
				<div class="message-content">
					<div class="message-info">
						<span class="message-name">Me</span>
						<span class="message-time">'.date_format(new DateTime($item->SendDate), 'd/m/Y H:i A').'</span>
					</div>
					<div class="message-text">'.$item->Message.'</div>
				</div>
			</li>';

    } else {
        $messageItem = '<li class="message-item friend">
				<div class="message-avt" style="background-image: url('.$avt5.')"></div>
				<div class="message-content">
					<div class="message-info">
						<span class="message-name">F. Possimus</span>
						<span class="message-time">'.date_format(new DateTime($item->SendDate), 'd/m/Y H:i A').'</span>
					</div>
					<div class="message-text">'.$item->Message.'</div>
				</div>
			</li>';
    }
    $messageList = $messageList . $messageItem;
}

echo $messageList;

function getAllMessageWithFriend ($userid, $friendid) {
    $sql = "select * from tbl_message where (userid = '".$userid."' OR userid = '".$friendid."') AND (friendid = '".$userid."' OR friendid = '".$friendid."') ORDER BY senddate ASC";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new Message();
        $item->MessId = $seletedItem['messid'];
        $item->UserId = $seletedItem['userid'];
        $item->FriendId = $seletedItem['friendid'];
        $item->Message = $seletedItem['message'];
        $item->SendDate = $seletedItem['senddate'];
        $result[$i] = $item;
        $i++;
    }
    return $result;
}

?>