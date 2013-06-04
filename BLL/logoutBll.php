<?php
    session_start();
    include '../DAO/connection.php';
    unset($_SESSION['email']);
    unset($_SESSION['userId']);
    unset($_SESSION['avatar']);
    session_destroy();
    echo "success";
?>