<?php

include '../DAO/connection.php';
include '../DTO/object.php';

$param1 = $_POST['date1'];
$param2 = $_POST['date2'];

if ($param2 == 1) {
   // echo '<script>alert("asd");</script>';
     $sql = "select a.userid ,a.datesubmit , a.score , u.name , u.avatar
            from tbl_activityhistory a join tbl_user u on a.userid = u.id
            where a.datesubmit = '".$param1."'
            ORDER BY a.score DESC
            limit 0,10";
} else {
     $sql = "select a.userid ,a.datesubmit , a.score , u.name , u.avatar
            from tbl_activityhistory a join tbl_user u on a.userid = u.id
            where a.datesubmit >= '".$param1."' and a.datesubmit <= '".$param2."'
            ORDER BY a.score DESC
            limit 0,10";
}


   
    
    
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo $sql;
        exit;
    }
    
    $girdView = "";
    $i = 1;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $html = ' <li class="menu-popup-item odd">
                    <span class="menu-popup-num">'.$i.'</span>
                    <span class="menu-popup-avt" style="background-image:url('.$seletedItem['avatar'].')"></span>
                    <span class="menu-popup-user">'.$seletedItem['name'].'</span>
                    <span class="menu-popup-score">'.$seletedItem['score'].'</span>
                </li>
                ';
        $girdView = $girdView . $html;
        $i++;
    }
    echo $girdView;
    

?>
                            