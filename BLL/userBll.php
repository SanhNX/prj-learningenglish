<?php

function login ($email, $pword) {
    $sql = "SELECT * FROM tbl_user Where Password = $pword AND Email = '".$email."'";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    $item = new User();
    $item->Id = $seletedItem['Id'];
    $item->Email = $seletedItem['Email'];
    $item->FullName = $seletedItem['FullName'];
    $item->Avatar = $seletedItem['Avatar'];
    $item->DOB = $seletedItem['DOB'];
    $item->Gender = $seletedItem['Gender'];
    $item->FavoriteTeam = $seletedItem['FavoriteTeam'];
    $item->Scores = $seletedItem['Scores'];
    return $item;
}


function emailExist($email) {
    $sql = "SELECT * FROM tbl_user Where email = '".$email."'";
    $queryResult = mysql_query($sql);
    
    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }
    
    if (mysql_num_rows($queryResult) > 0)
        return  1;
    else
        return -1;
}


function insertUser ($fname, $email, $pword, $joindate, $gender, $avatar){
    $sql = "INSERT INTO tbl_user 
                ( name, email, password, joindate, gender, avatar, status) 
                VALUES ('$fname', '$email', '$pword', '$joindate', '$gender', '$avatar', '1')";              
    $queryResult = mysql_query($sql) or die(mysql_error());
    
    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }
    
    if ($queryResult)
        return mysql_insert_id();
    else
        return -1;
}

function getInforUserById ($id) {
    $sql = "SELECT * FROM tbl_user Where Id = $id";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    $item = new User();
    $item->id = $seletedItem['id'];
    $item->name = $seletedItem['name'];
    $item->email = $seletedItem['email'];
    $item->joindate = $seletedItem['joindate'];
    $item->gender = $seletedItem['gender'];
    $item->avatar = $seletedItem['avatar'];
    $item->status = $seletedItem['status'];
    return $item;
}

?>