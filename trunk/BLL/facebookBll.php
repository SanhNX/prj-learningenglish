<?php

/**
 * @author thanh
 * @copyright 2013
 */
function idFaceExist($id) {
    $sql = "SELECT * FROM tbl_facebook Where IdFaceBook = '".$id."'";
    $queryResult = mysql_query($sql);
    
    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    if (mysql_num_rows($queryResult) > 0) {
		return  $seletedItem['Id'];
	}
        
    else
        return -1;
}

function insertUserFace ($idface, $fullname, $avatar){
    $sql = "INSERT INTO tbl_facebook 
                (IdFaceBook, FullName, Avatar, Scores) 
                VALUES ('$idface', '$fullname', '$avatar', 0)";              
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
?>