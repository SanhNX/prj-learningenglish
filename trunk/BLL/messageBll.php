<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/userBll.php';
$flag = $_POST['flag'];
$userid = $_SESSION['userid'];
$friendid = $_POST['friendid'];
if($flag == 'initConversation'){

    $result = getAllMessageWithFriend($userid, $friendid);
    $messageList = "";
    $avt0 = "images/resource/avt0.jpg";
    $avt5 = "images/resource/metro/m5.jpg";
    $user = getInforUserById($userid);
    $friend = getInforUserById($friendid);
    for ($i = 0; $i < count($result); $i++) {
        $item = $result[$i];
        $messageItem = "";
        if($item->UserId == $userid){
            $messageItem = '<li class="message-item">
				<div class="message-avt" style="background-image: url('.$_SESSION['avatar'].')"></div>
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
				<div class="message-avt" style="background-image: url('.$friend->avatar.')"></div>
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
}

if($flag == 'sendMessage'){
    $now = getdate();
    $senddate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"] . " " . ($now["hours"] + 1) . ":" . $now["minutes"] . ":" . $now["seconds"];
    $result = sendMessage($userid, $friendid, $_POST['message'], $senddate);
    if($result == -1)
        echo 'fail';
    else
        echo 'success';
}


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

function sendMessage ($userid, $friendid, $message, $senddate){
    $sql = "INSERT INTO tbl_message ( userid, friendid, message, senddate) VALUES ('$userid','$friendid', '$message', '$senddate')";
    $queryResult = mysql_query($sql) or die(mysql_error());

    if (!$queryResult) {
        echo 'Error: ' . mysql_error();
        return -1;
    }

    if ($queryResult)
        return mysql_insert_id();
    else
        return -1;
}

?>