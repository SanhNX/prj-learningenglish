<?php

class User{
	var $id;
	var $email;
	var $password;
	var $profilepic;
	var $joindate;
	var $gender;
	var $birthday;
	var $school;
	var $work;
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