<?php
    session_start();
    include '../DAO/connection.php';
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_name']);
    session_destroy();
    echo "success";
?>