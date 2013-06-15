<?php
session_start();
include '../DAO/connection.php';
include '../BLL/articleBLL.php';
include '../DTO/object.php';

$article = getArticleById($_POST['idArticle']);
echo json_encode($article);
?>