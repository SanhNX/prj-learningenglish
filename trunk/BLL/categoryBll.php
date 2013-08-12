<?php
function getAllCategory () {
    $sql = "SELECT * FROM tbl_category ORDER BY name ASC";
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
function getAllCategoryForEveryone () {
    $sql = "SELECT * FROM tbl_category where description = 'For Everyone' ORDER BY name ASC";
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
function getAllCategoryForKids () {
    $sql = "SELECT * FROM tbl_category where description = 'For Kids' ORDER BY name ASC";
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