<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

$isExist = emailExist($_POST['email']);
if ($isExist == 1) {
    echo 'exist';
} else {
    echo 'notexist';
}

