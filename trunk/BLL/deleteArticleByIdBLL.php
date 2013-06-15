<?php
session_start();
include '../DAO/connection.php';
include '../BLL/articleBLL.php';
include '../DTO/object.php';

$isExist = checkExistArticleInActivity($_POST['idArticle']);

if($isExist == -1){
    $isDel = deleteArticleById($_POST['idArticle']);
    if($isDel == 1)
        echo 'success';
    else
        echo 'fail';
} else{
    echo 'fail';
}

?>