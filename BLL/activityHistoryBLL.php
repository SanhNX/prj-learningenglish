<?php

function countScore($id) {
    $sql2 = "SELECT   SUM(score) AS sumcore
                FROM tbl_activityhistory where userid = '" . $id . "'";

    $queryResult = mysql_query($sql2);
    if (!$queryResult) {
        echo 'Can not run query!!!!!';
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);
    return $seletedItem['sumcore'];
}

function getInforTestofUser($id) {
//    $sql = "SELECT  ar.id, ar.title ,ac.score
//        FROM tbl_activityhistory ac 
//            JOIN tbl_article ar ON ac.articleid = ar.id
//        WHERE ac.userid  = $id
//       ORDER BY ac.historyid DESC ";

    $sql1 .=" SELECT T1.id, T1.title, T1.score, T1.historyid, T2.ranking ,T1.datesubmit
                FROM 
                    (SELECT  ar.id, ar.title ,ac.score, ac.historyid , ac.datesubmit
                        FROM tbl_activityhistory ac 
                            JOIN tbl_article ar ON ac.articleid = ar.id
                        WHERE ac.userid  = '" . $id . "') AS T1
                    JOIN
                    (SELECT historyid
                          , score
                          , userid
                          ,articleid
                          , @num := if(@points >= score and @articleid = articleid , @num + 1, @num := 1) as ranking
                          , @points := score as dummy
                          , @articleid := articleid as dummy1
                        FROM tbl_activityhistory , (SELECT @points := null, @articleid := -1, @num := 0) r
                        ORDER BY articleid , score DESC) AS T2
                    ON T1.historyid = T2.historyid
                ORDER BY T1.historyid DESC ";
    $queryResult = mysql_query($sql1);
    if (!$queryResult) {
        echo $sql1;
        exit;
    }
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new UserInfor();
        $item->idAr = $seletedItem['id'];
        $item->titleAr = $seletedItem['title'];
        $item->score = $seletedItem['score'];

        $item->ranking = $seletedItem['ranking'];
        $item->date = $seletedItem['datesubmit'];

        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function addActivityHistory($userid, $articleid, $datesubmit, $score) {
    $sql = "INSERT INTO tbl_activityhistory (userid, articleid, datesubmit, score) VALUES ('$userid', '$articleid', '$datesubmit', '$score')";
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

function getActivityHistoryByArticleId($id) {
    $sql = "SELECT * FROM tbl_activityhistory WHERE articleid = '" . $id . "' ORDER BY score DESC";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }
    $i = 0;
    $result = null;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
//        echo '<script>alert("' . $seletedItem['userid'] . '")</script>';
        $item = new ActivityHistory();
        $item->historyid = $seletedItem['historyid'];
        $item->userid = $seletedItem['userid'];
        $item->articleid = $seletedItem['articleid'];
        $item->datesubmit = $seletedItem['datesubmit'];
        $item->score = $seletedItem['score'];
        
        $result[$i] = $item;
        $i++;
    }
    return $result;
}

?>
                            