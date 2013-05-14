<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

//    echo 'Email: '.$_POST['email'].'<br>';
//    echo 'Password: '.$_POST['pass'].'<br>';
//    echo 'Full Name: '.$_POST['name'].'<br>';
// Các xử lý để chèn vào Database!

$excuteQuery = insertUser($_POST['name'], $_POST['email'], $_POST['pass'], '', true, '');
if ($excuteQuery == -1) {
    echo 'false';
} else {
    echo 'true';
}

