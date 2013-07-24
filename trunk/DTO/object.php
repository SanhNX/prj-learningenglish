<?php

class User{
	var $id;
        var $name;
	var $email;
	var $password;
	var $avatar;
	var $joindate;
	var $gender;
	var $status;
}

class Admin{
    var $id;
    var $name;
    var $email;
}

class Category{
	var $id;
	var $name;
	var $description;
}

class Article{
	var $idArticle;
	var $idvideo;
	var $categoryid;
	var $title;
	var $link;
	var $thumbnail;
	var $duration;
	var $level;
	var $timesplay;
	var $datecreate;
}
class ActivityHistory{
	var $historyid;
	var $userid;
	var $articleid;
	var $datesubmit;
	var $score;
}

class UserInfor{
	var $idAr;
	var $titleAr;
	var $score;
	var $ranking;
        var $date;
}

class Message{
    var $messid;
    var $userid;
    var $friendid;
    var $message;
    var $senddate;
}
?>