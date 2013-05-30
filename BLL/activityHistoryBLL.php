<?php


function getInforTestofUser($id) {
    $sql = "SELECT  ar.id, ar.title ,ac.score
        FROM tbl_activityhistory ac 
            JOIN tbl_article ar ON ac.articleid = ar.id
        WHERE ac.userid  = $id
       ORDER BY ac.historyid DESC ";
        

        $queryResult = mysql_query($sql);
        if (!$queryResult) {
            echo 'Could not run query: ';
            exit;
        }
         $i = 0;
        $result = null;
        while ($seletedItem = mysql_fetch_array($queryResult)) {
            $item = new UserInfor();
            $item->idAr = $seletedItem['id'];
            $item->titleAr = $seletedItem['title'];
            $item->score = $seletedItem['score'];

           // $item->ranking = $seletedItem['title'];

            $result[$i] = $item;
            $i++;
        }
        return $result;
       }
?>
                            