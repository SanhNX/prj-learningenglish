<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';

$isExist = checkExistAdmin($_POST['txtemail'], $_POST['txtpass']);
if ($isExist == 0)
    echo 'fail';
else {
    $user = getAccountAdmin($_POST['txtemail'], $_POST['txtpass']);

    //Store the name in the session
    $_SESSION['admin_id'] = $user->id;
    $_SESSION['admin_email'] = $user->email;
    $_SESSION['admin_name'] = $user->name;
    echo 'success';
    //    redirect($_SERVER['REQUEST_URI']);
}

function checkExistAdmin($email, $pass) {
    $sql = "SELECT * FROM  tbl_admin WHERE email = '" . $email . "' AND password = '" . $pass . "'";
    $result = mysql_query($sql);
    if (!$result) {
        echo 'Could not run query: ' . $email . mysql_error();
        exit;
    }
    // Mysql_num_row is counting table row
    $count = mysql_num_rows($result);
    return $count;
}

function getAccountAdmin($email, $pass) {
    $sql = "SELECT * FROM  tbl_admin WHERE email = '" . $email . "' AND password = '" . $pass . "'";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    $item = new Admin();
    $item->id = $seletedItem['id'];
    $item->email = $seletedItem['email'];
    $item->name = $seletedItem['name'];
    return $item;
}
?>