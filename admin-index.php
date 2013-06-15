<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/userBll.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/admin-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
    <script type="text/javascript" src="scripts/date.js"></script>
    <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
    <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="scripts/effect.js"></script>
    <script type="text/javascript" src="scripts/ajax-admin.js"></script>
    <script type="text/javascript" src="scripts/admin_user.js"></script>
</head>
<body>
<div class="page">
    <div class="nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="admin-video.php">Manager Video</a></li>
            <li class="nav-item"><a href="admin-user.php">Manager User</a></li>
            <li class="nav-item"><a href="#">...</a></li>
            <li class="nav-item"><a href="#">...</a></li>
            <li class="nav-item"><a href="#">...</a></li>
        </ul>
    </div>

    <div class="form-head">
        <span>Welcome Administrator</span><span
            class="form-head-gray"> • Please choose function you want manager !</span>

        <div class="form-head-task">
            <?php
            $avatar = 'images/resource/admin.gif';
            if (isset($_SESSION["admin_email"])) {
                echo '<div class="form-head-account">
                        <div class="form-head-account-wrapper">
                            <div class="form-head-profile">
                                <span>' . $_SESSION['admin_name'] . '</span>
                                <span class="menu-popup-avt" style="background-image:url(' . $avatar . ')"></span>
                            </div>
                            <div class="form-head-logout"><a id="btn-admin-logout">Logout</a></div>
                        </div>
                    </div>';
            } else {
                echo '<script type="text/javascript">warningAuthorize()</script>';
                exit();
            }
            ?>
        </div>
    </div>
    <div class="form">


    </div>
</div>
</body>
</html>