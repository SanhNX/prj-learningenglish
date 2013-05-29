<?php
function getArticleByCategoryid($id, $pa) {
    $check1 = 22 * $pa;
    $display = 22;
    if ($check1 > 22) {
        $page = 22 * ($pa - 1);
    } else {
        $page = 0;
    }

    if ($id != null && $id != "") {
        $sql = "SELECT * FROM tbl_article Where categoryid = '" . $id . "' LIMIT $page, $display";
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
        $item = new Article();
        $item->idArticle = $seletedItem['id'];
        $item->idvideo = $seletedItem['idvideo'];
        $item->categoryid = $seletedItem['categoryid'];

        $item->title = $seletedItem['title'];
        $item->link = $seletedItem['link'];
        $item->thumbnail = $seletedItem['thumbnail'];
        $item->duration = $seletedItem['duration'];

        $item->level = $seletedItem['level'];
        $item->timesplay = $seletedItem['timesplay'];
        $item->datecreate = $seletedItem['datecreate'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function searchByTitle($key) {
    $sql = "select * from tbl_article where title like '%$key%'";

    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo $sql;
        exit;
    }

    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new Article();
        $item->idArticle = $seletedItem['id'];
        $item->idvideo = $seletedItem['idvideo'];
        $item->categoryid = $seletedItem['categoryid'];

        $item->title = $seletedItem['title'];
        $item->link = $seletedItem['link'];
        $item->thumbnail = $seletedItem['thumbnail'];
        $item->duration = $seletedItem['duration'];
        $item->level = $seletedItem['level'];
        $item->timesplay = $seletedItem['timesplay'];
        $item->datecreate = $seletedItem['datecreate'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function getArticleById($id) {
    $sql = "SELECT * FROM tbl_article Where id = '" . $id . "' ";
    $queryResult = mysql_query($sql) or die("Couldn't execute query.");

    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);

    $item = new Article();
    $item->idArticle = $seletedItem['id'];
    $item->idvideo = $seletedItem['idvideo'];
    $item->categoryid = $seletedItem['categoryid'];
    $item->title = $seletedItem['title'];
    $item->link = $seletedItem['link'];
    $item->thumbnail = $seletedItem['thumbnail'];
    $item->duration = $seletedItem['duration'];
    $item->level = $seletedItem['level'];
    $item->timesplay = $seletedItem['timesplay'];
    $item->datecreate = $seletedItem['datecreate'];
    return $item;
}

?>