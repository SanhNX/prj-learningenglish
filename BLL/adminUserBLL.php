<?php

include '../DAO/connection.php';
include '../BLL/userBll.php';

$param1 = $_POST['id'];
$param2 = $_POST['status'];

$check = updateUser($param1, $param2) ;
//
echo $check = $check."_".$param2."_".$param1;     
?>