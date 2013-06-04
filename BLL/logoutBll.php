<?php
    session_start();
    include '../DAO/connection.php';
    unset($_SESSION['email']);
    unset($_SESSION['userid']);
    unset($_SESSION['avatar']);
    session_destroy();
    echo "success";
?>