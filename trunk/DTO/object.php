<?php

class User{
	var $id;
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
    var $level;
	var $timesplay;
	var $datecreate;
}

?>