<?php

include '../DAO/connection.php';

$sql = "SELECT ac.score, ar.id as idar, ar.title , us.id as idus, us.name, us.avatar
        FROM tbl_activityhistory ac 
            JOIN tbl_article ar ON ac.articleid = ar.id
            JOIN tbl_user us ON ac.userid = us.id
        WHERE ac.datesubmit = CURDATE()
        LIMIT 0, 10";


 $queryResult = mysql_query($sql);
 if (!$queryResult) {
     echo 'Could not run query: ';
     exit;
 }
 $girdView = "";
 $i = 1;
 $space = " ";
 while ($seletedItem = mysql_fetch_array($queryResult)) {     
     $html = '<li class="control-rank-item">'.$i.''.$space.'->'.$space.'<a href="#">'.$seletedItem['name'].'</a>'.$space.'receives'.$space.''.$seletedItem['score'].''.$space.'points for this video.'.$space.'<a href="#">'.$seletedItem['title'].'</a></li>';
     $girdView = $girdView . $html;
     $i++;
 }
echo $girdView;
?>
                            