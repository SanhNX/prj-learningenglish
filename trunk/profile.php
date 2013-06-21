<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/userBll.php';
include 'BLL/activityHistoryBLL.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive-style.css" rel="stylesheet" type="text/css"/>
        <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
        <script type="text/javascript" src="scripts/facebookAPI.js"></script>
        <script type="text/javascript" src="scripts/ajax-userprocess.js"></script>
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
                                <div class="form-head-account-wrapper">
                                        <div class="form-head-profile">
                                                <span>' . $_SESSION["email"] . '</span>
                                                <span class="menu-popup-avt" style="background-image:url(' . $_SESSION["avatar"] . ')"></span>
                                        </div><div class="form-head-logout"><a>Profile</a><a id="btn-logout">Logout</a></div>
                                </div>
                                </div>';
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
                    if ($itemUser->gender == 0) {
                        $gender = "Female";
                    } else {
                        $gender = "Male";
                    }
                    echo '    
                    <div class="profile-tag">
                            <div class="profile-head">Infomation</div>
                            <div class="profile-avt" style="background-image:url(' . $itemUser->avatar . ')"></div>
                            <div class="profile-title white">Name :</div>
                            <div class="profile-text white">' . $itemUser->name . '</div>
                            <div class="profile-title white">Email :</div>
                            <div class="profile-text white">' . $itemUser->email . '</div>
                            <div class="profile-title white">Gender :</div>
                            <div class="profile-text white">' . $gender . '</div>
                            <div class="profile-title white">Join Date :</div>
                            <div class="profile-text white">' . date_format(new DateTime($itemUser->joindate), 'd/m/Y') . '</div>
                    </div>
                    <div class="profile-panel">
                            <div class="profile-head">Result</div>
                            <div class="profile-name">lIST OF COMPLETED VIDEOS</div>
                            <div class="profile-title">Total score : ' . countScore($id) . ' points  </div>
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
                        $itemUserInforTest = $itemListUser[$y];
                        $date = new DateTime($itemUserInforTest->date);
                        echo '
                    <li class="rank-row-item">
                        <span class="rank-row-num">' . ($y + 1) . '</span>
                        <a href="play.php?id=' . $itemUserInforTest->idAr . '" class="rank-row-name">' . $itemUserInforTest->titleAr . '</a>
                        <span class="rank-row-point">' . $itemUserInforTest->score . '</span>
                        <span class="rank-row-point">' . $itemUserInforTest->ranking . '</span>
                        <span class="rank-row-time">' . date_format($date, 'd/m/Y') . '</span>
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
<?php
include 'common/login-register.php';
?>
            </div>
    </body>
</html>