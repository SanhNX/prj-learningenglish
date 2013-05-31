<?php
function countScore($id) {
    $sql2 = "SELECT   SUM(score) AS sumcore
                FROM tbl_activityhistory where userid = '".$id."'";
    
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
                
    $sql1 .=" SELECT T1.id, T1.title, T1.score, T1.historyid, T2.ranking
                FROM 
                    (SELECT  ar.id, ar.title ,ac.score, ac.historyid
                        FROM tbl_activityhistory ac 
                            JOIN tbl_article ar ON ac.articleid = ar.id
                        WHERE ac.userid  = '".$id."') AS T1
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

            $result[$i] = $item;
            $i++;
        }
        return $result;
       }
?>
                            