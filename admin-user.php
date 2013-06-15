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
		<span>Learning-English</span><span class="form-head-gray"> • Manager User</span>

        <div class="form-head-task">
            <?php
            $avatar = 'images/resource/admin.gif';
            if (isset($_SESSION["admin_email"])) {
                echo '<div class="form-head-account">
                        <div class="form-head-account-wrapper">
                            <div class="form-head-profile">
                                <span>'.$_SESSION['admin_name'].'</span>
                                <span class="menu-popup-avt" style="background-image:url('.$avatar.')"></span>
                            </div>
                            <div class="form-head-logout"><a id="btn-admin-logout">Logout</a></div>
                        </div>
                    </div>';
            }  else {
                echo '<script type="text/javascript">warningAuthorize()</script>';
                exit();
            }
            ?>
        </div>
	</div>
	<div class="form">
            <div class="profile-panel" style="width: 1200px;">
		<ul class="control-rank-list profile">
			<li class="rank-row-item head">
				<span href="" class="rank-row-name" style="font-size: 18px;">Name </span>
				<span class="rank-row-name" style="font-size: 18px;">Email </span>
                                <span href="" class="rank-row-time" style="font-size: 18px;">Gender</span>
                                <span href="" class="rank-row-time" style="font-size: 18px;">Status</span>
			</li>
                        <?php
                            $listAllUser = getAllInforUser();
                            $gender = null;
                            for ($y = 0; $y < count($listAllUser); $y++) {
                                $itemUserInfor  = $listAllUser[$y];
                                 if ($itemUserInfor->gender == 0) {$gender = "Female";} else {$gender = "Male";}
                                echo '
                                    <li class="rank-row-item">
                                    <span class="rank-row-num">'.($y + 1).'</span>
                                    <span href="" class="rank-row-name" style="font-size: 16px;">'.$itemUserInfor->name.'</span>
                                    <span class="rank-row-name" style="font-size: 16px;">'.$itemUserInfor->email.'</span>
                                    <span href="" class="rank-row-time" style="font-size: 16px;">'.$gender.'</span>
                                    ';
                                if ($itemUserInfor->status == 1) {
                                    echo '<span href="" class="rank-row-time" id="'.$itemUserInfor->id.'" style="font-size: 16px;">
                                            <input class="admin-button submit" type="button" onclick="updateUser('.$itemUserInfor->id.','.$itemUserInfor->status.');" style="height: 34px;" value="Active"/>
                                        </span>
                                         </li>
                                        ';
                                } else {
                                    echo '<span href="" class="rank-row-time" id="'.$itemUserInfor->id.'" style="font-size: 16px;">
                                            <input class="admin-button cancel" type="button" onclick="updateUser('.$itemUserInfor->id.','.$itemUserInfor->status.');" style="height: 34px;" value="Inactive"/>
                                        </span>
                                         </li>
                                        ';
                                }
                                    
                            }
                        ?>

<!--			<li class="rank-row-item">
                                <span class="rank-row-num">1</span>
				<span href="" class="rank-row-name" style="font-size: 16px;">Name </span>
				<span class="rank-row-name" style="font-size: 16px;">Email </span>
                                <span href="" class="rank-row-time" style="font-size: 16px;">Gender</span>
                                <span href="" class="rank-row-time" style="font-size: 16px;">
                                    
                                </span>
                        </li>
                        <li class="rank-row-item">
                                <span class="rank-row-num">1</span>
				<span href="" class="rank-row-name" style="font-size: 16px;">Name </span>
				<span class="rank-row-name" style="font-size: 16px;">Email </span>
                                <span href="" class="rank-row-time" style="font-size: 16px;">Gender</span>
                                <span href="" class="rank-row-time" style="font-size: 16px;">
                                    
                                </span>
                        </li>-->
<!--			<li class="rank-row-item more">
				<span class="rank-row-button more">More</span>
			</li>-->
		</ul>

            </div>
	</div>
</div>
</body>
</html>