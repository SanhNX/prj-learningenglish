<?php
session_start();
include '../DAO/connection.php';
include '../DTO/object.php';

$isExist = checkExistEmail($_POST['txtemail'], $_POST['txtpass']);
//echo '<script>alert("'.$isExist.'");</script>';   
if ($isExist == 0)
    echo 'fail';
else {
    $user = getUserByEmailPass($_POST['txtemail'], $_POST['txtpass']);

    //Store the name in the session
    $_SESSION['UserName'] = $user->FullName;
    $_SESSION['UserId'] = $user->Id;
    $_SESSION['UserAvatar'] = $user->Avatar;
    echo 'success';    
    //    redirect($_SERVER['REQUEST_URI']);
}

function checkExistEmail($email, $pass) {
    $sql = "SELECT * FROM  tbl_user WHERE Email = '" . $email . "' AND Password = '" . $pass . "' ";
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
    $sql = "SELECT * FROM  tbl_user WHERE Email = '" . $email . "' AND Password = '" . $pass . "' ";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $email . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    $item = new User();
    $item->Id = $seletedItem['Id'];
    $item->Email = $seletedItem['Email'];
    $item->Password = $seletedItem['Password'];
    $item->FullName = $seletedItem['FullName'];
    $item->Avatar = $seletedItem['Avatar'];
    $item->DOB = $seletedItem['DOB'];
    $item->Gender = $seletedItem['Gender'];
    $item->FavoriteTeam = $seletedItem['FavoriteTeam'];
    $item->Scores = $seletedItem['Scores'];
    return $item;
}

?>