<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';

$usingfb = $_POST['usingfb'];
if(!$usingfb)
{
    $isExist = checkExistEmail($_POST['txtemail'], $_POST['txtpass']);
    //echo '<script>alert("'.$isExist.'");</script>';
    if ($isExist == 0)
        echo 'fail';
    else {
        $user = getUserByEmailPass($_POST['txtemail'], $_POST['txtpass']);

        //Store the name in the session
        $_SESSION['email'] = $user->email;
        $_SESSION['userId'] = $user->id;
        $_SESSION['avatar'] = $user->avatar;
        echo 'success';    
        //    redirect($_SERVER['REQUEST_URI']);
    }
} else {
     //Store the name in the session
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['userId'] = $_POST['fbid'];
    $_SESSION['avatar'] = 'https://graph.facebook.com/'.$_POST['fbid'].'/picture?type=large';
    echo 'success_fb'; 
}

function checkExistEmail($email, $pass) {
    $sql = "SELECT * FROM  tbl_user WHERE email = '" . $email . "' AND password = '" . $pass . "' AND status = 1";
    $result = mysql_query($sql);
    if (!$result) {
        echo 'Could not run query: ' . $email . mysql_error();
        exit;
    }
    // Mysql_num_row is counting table row
    $count = mysql_num_rows($result);
    return $count;
}

function getUserByEmailPass($email, $pass) {
    $sql = "SELECT * FROM  tbl_user WHERE email = '" . $email . "' AND password = '" . $pass . "' ";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $email . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    $item = new User();
    $item->id = $seletedItem['id'];
    $item->email = $seletedItem['email'];
    $item->password = $seletedItem['password'];
    $item->joindate = $seletedItem['joindate'];
    $item->avatar = $seletedItem['avatar'];
    $item->gender = $seletedItem['gender'];
    $item->status = $seletedItem['status'];
    return $item;
}

?>