<?php

/**
 * @author thanh
 * @copyright 2013
 */

function getArticleByCategoryid ($id, $pa) {
    $display = 22 * $pa;
    $page = 0;
    if ($id != null) {
        $sql = "SELECT * FROM tbl_article Where categoryid = '".$id."' LIMIT $page, $display";
    } else {
        $sql = "SELECT * FROM tbl_article LIMIT $page, $display";
    }
    
    
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ';
        exit;
    }
	
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new Category();
        $item->idArticle = $seletedItem['id'];
        $item->idvideo = $seletedItem['idvideo'];
        $item->categoryid = $seletedItem['categoryid'];
        
        $item->title = $seletedItem['title'];
        $item->link = $seletedItem['link'];
        $item->thumbnail = $seletedItem['thumbnail'];
        
        $item->level = $seletedItem['level'];
        $item->timesplay = $seletedItem['timesplay'];
        $item->datecreate = $seletedItem['datecreate'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}
?>