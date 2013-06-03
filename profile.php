<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/userBLL.php';
include 'BLL/activityHistoryBLL.php';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<link href="css/responsive-style.css" rel="stylesheet" type="text/css"/>
	<link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
	<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
	<script type="text/javascript" src="scripts/date.js"></script>
	<script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
	<script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
        <script type="text/javascript" src="scripts/ajax-rankingdate.js"></script>
</head>
<body>
<div class="page">
<?php
    include 'common/menu.php';
?>

<div class="form-head">
	<span>Learning-English</span><span class="form-head-gray">Profile</span>

	<div class="form-head-task">
		 // ------------ Check user login----------------//
                    <?php
                    if (isset($_SESSION["email"])) {
                        echo '<div class="form-head-account">
                                <span>' . $_SESSION["email"] . '</span>
                                <span class="menu-popup-avt" style="background-image:url(' . $_SESSION["avatar"] . ')"></span></div>';
                    }
                    ?>

	</div>
</div>
<div class="form">
    <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $itemUser = getInforUserById($id);
            $gender = null;
            if ($itemUser->gender == 0) {$gender = "Female";} else {$gender = "Male";}
            echo '    
                    <div class="profile-tag">
                            <div class="profile-head">Infomation</div>
                            <div class="profile-avt" style="background-image:url('.$itemUser->avatar.')"></div>
                            <div class="profile-title white">Name :</div>
                            <div class="profile-text white">'.$itemUser->name.'</div>
                            <div class="profile-title white">Email :</div>
                            <div class="profile-text white">'.$itemUser->email.'</div>
                            <div class="profile-title white">Gender :</div>
                            <div class="profile-text white">'.$gender.'</div>
                            <div class="profile-title white">Join Date :</div>
                            <div class="profile-text white">'.$itemUser->joindate.'</div>
                    </div>
                    <div class="profile-panel">
                            <div class="profile-head">Result</div>
                            <div class="profile-name">lIST OF COMPLETED VIDEOS</div>
                            <div class="profile-title">Total score : '.  countScore($id).' points  </div>
                            <ul class="control-rank-list profile">
                 ';
            $itemListUser = getInforTestofUser($id);
            echo '		
                        <li class="rank-row-item head">
				<span href="" class="rank-row-name">Video Name</span>
				<span class="rank-row-point">Points </span>
                                <span class="rank-row-point">Ranking </span>
				<span href="" class="rank-row-time">Date time</span>
			</li>
		';	
            for ($y = 0; $y < count($itemListUser); $y++) {
                $itemUserInforTest  = $itemListUser[$y];
                $date = new DateTime($itemUserInforTest->date);
                echo '
                    <li class="rank-row-item">
                        <span class="rank-row-num">'.($y + 1).'</span>
                        <a href="play.php?id='.$itemUserInforTest->idAr.'" class="rank-row-name">'.$itemUserInforTest->titleAr.'</a>
                        <span class="rank-row-point">'.$itemUserInforTest->score.'</span>
                        <span class="rank-row-point">'.$itemUserInforTest->ranking.'</span>
                        <span class="rank-row-time">'.date_format($date, 'd/m/Y').'</span>
                    </li>
                    ';
            }
            
            
            echo '           </ul>

                            </div>
                    </div>
                ';
            } else {
              //  header("location: index.php");
            }
            ?>
<div class="popup disable">
	<div class="popup-back"></div>
	<div class="popup-form login">
		<div class="popup-wrapper">
			<div class="login-avt"></div>
			<div class="login-info">
				<div class="login-info-title">
					<span>Đăng nhập</span>

					<div class="popup-progress" style="display: block"></div>
				</div>
				<div class="login-info-row"><span class="login-info-label">Tên tài khoản:</span>
					<input class="login-info-input" type="text" value=""/>
				</div>
				<div class="login-info-row"><span class="login-info-label">Mật khẩu:</span>
					<input class="login-info-input" type="password" value=""/>
				</div>
				<div class="login-info-row large">
					<a class="login-info-link">Quên mật khẩu?</a>
					<a class="login-info-button">Đăng nhập</a>
				</div>
				<div class="login-info-row">
					<a class="login-info-link" id="login-info-link-register">Chưa có tài khoản?</a>
				</div>
			</div>
		</div>
	</div>
	<div class="popup-form register">
		<div class="popup-wrapper">
			<div class="login-info">
				<div class="login-info-title">
					<span>Đăng kí</span>

					<div class="popup-progress" style="display: block"></div>
				</div>
				<div class="login-info-row error">
					<span class="login-info-label">Tên tài khoản:</span>
					<input class="login-info-input" placeholder="Không quá 12 ký tự" type="text" value=""/>
				</div>
				<div class="login-info-row error">
					<span class="login-info-label">Email:</span>
					<input class="login-info-input" type="text" value=""/>
				</div>
				<div class="login-info-row">
					<span class="login-info-label">Xác nhận email:</span>
					<input class="login-info-input" type="text" value=""/>
				</div>
				<div class="login-info-row ok"><span class="login-info-label">Mật khẩu:</span>
					<input class="login-info-input" type="password" value=""/>
				</div>
				<div class="login-info-row"><span class="login-info-label">Xác nhận mật khẩu:</span>
					<input class="login-info-input" type="password" value=""/>
				</div>
				<div class="login-info-row large">
					<a class="login-info-button">Đăng kí</a>
				</div>
			</div>
			<div class="login-message">
				<div class="login-message-content">
					Xảy ra sự cố trong quá trình đăng kí...<br/>
					- Tên đăng nhập không hợp lệ<br/>
					- Email không hợp lệ<br/>
					- ...<br/>
				</div>
				<div class="login-message-footer"></div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>