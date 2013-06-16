<?php
include '../DAO/connection.php';

$cateid = $_POST['cateid'];
$level = $_POST['level'];
$idArticle = $_POST['idArticle'];
$isEdit = editVideo($idArticle, $cateid, $level);
if($isEdit == -1){
    echo 'false';
} else {
    $file = fopen("../data-video/".$idArticle.".json","w+") or exit("Unable to open file!");
    $content = str_replace("readonly='true'", "", $_POST['content']);
    $content = str_replace("value='true'", "", $content);

    fwrite($file,$content);
    fclose($file);
    echo 'true';
}

function editVideo ($id, $cateid, $level){
    $sql = 'UPDATE tbl_article SET categoryid = '.$cateid .', level = '.$level.' WHERE id = '.$id;
    $queryResult = mysql_query($sql) or die(mysql_error());

    if (!$queryResult) {
        echo 'Error: ' . $id . mysql_error();
        return -1;
    }

    if ($queryResult)
        return 1;
    else
        return -1;
}
?>