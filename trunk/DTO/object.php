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

class UserInfor{
	var $idAr;
	var $titleAr;
	var $score;
	var $ranking;
}

?>