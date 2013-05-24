<?php

/**
 * @author thanh
 * @copyright 2013
 */

function getAllCategory () {
    $sql = "SELECT * FROM tbl_category";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ';
        exit;
    }
	
	$i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new Category();
        $item->id = $seletedItem['id'];
        $item->name = $seletedItem['name'];
        $item->description = $seletedItem['description'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}
?>