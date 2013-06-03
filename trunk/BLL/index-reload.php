<?php

include '../DAO/connection.php';

$sql = "SELECT ac.historyid, ac.score, ar.id as idar, ar.title , us.id as idus, us.name, us.avatar
        FROM tbl_activityhistory ac 
            JOIN tbl_article ar ON ac.articleid = ar.id
            JOIN tbl_user us ON ac.userid = us.id
        WHERE ac.datesubmit = CURDATE()
        ORDER BY ac.historyid DESC
        LIMIT 0, 20";


 $queryResult = mysql_query($sql);
 if (!$queryResult) {
     echo 'Could not run query: ';
     exit;
 }
 $girdView = "";
 $i = 1;
 $space = " ";
 while ($seletedItem = mysql_fetch_array($queryResult)) {     
   //  $html = '<li class="control-rank-item">'.$i.''.$space.'->'.$space.'<a href="#">'.$seletedItem['name'].'</a>'.$space.'receives'.$space.''.$seletedItem['score'].''.$space.'points for this video.'.$space.'<a href="#">'.$seletedItem['title'].'</a></li>';
     $html = '<li class="menu-popup-item odd">
                    <span class="menu-popup-num">'.$i.'</span>
                    <span class="menu-popup-avt" style="background-image:url('.$seletedItem['avatar'].')"></span>
                    <a href="profile.php?id='.$seletedItem['idus'].'" class="menu-popup-user">'.$seletedItem['name'].'</a>
                    <span class="menu-popup-mess">receives '.$seletedItem['score'].' points for this video.</span>
                    <a href="play.php?id='.$seletedItem['idar'].'" class="menu-popup-video-link">'.$seletedItem['title'].'</a>
              </li>';
     $girdView = $girdView . $html;
     $i++;
 }
echo $girdView;
?>
                            