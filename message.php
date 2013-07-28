<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
    <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
	<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-yii.css" rel="stylesheet" type="text/css"/>
    <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
	<link href="css/responsive-style.css" rel="stylesheet" type="text/css"/>

	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
    <script type="text/javascript" src="scripts/facebookAPI.js"></script>
    <script type="text/javascript" src="scripts/ajax-userprocess.js"></script>
    <script type="text/javascript" src="scripts/webtoolkit.aim.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
    <script type="text/javascript" src="scripts/date.js"></script>
    <script type="text/javascript" src="scripts/date.format.js"></script>
    <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
    <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.js"></script>
    <script type="text/javascript" src="scripts/ajax-rankingdate.js"></script>
    <script type="text/javascript" src="scripts/ajax-index.js"></script>
    <script type="text/javascript" src="scripts/ajax-synmessage.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="page">
    <?php
    include 'common/menu.php';
    ?>

</div>
<div class="form">
	<div class="form-head">
        <span>Learning-English</span><span class="form-head-gray"> • Message</span>
        <div class="form-head-task">
            // ------------ Check user login----------------//
            <?php
            if (isset($_SESSION["email"])) {
                echo '<div class="form-head-account">
                        <div class="form-head-account-wrapper">
                                <div class="form-head-profile">
                                        <span>' . $_SESSION["email"] . '</span>
                                        <span class="menu-popup-avt" style="background-image:url(' . $_SESSION["avatar"] . ')"></span>
                                </div><div class="form-head-logout"><a href="profile.php?id='.$_SESSION['userid'].'">Profile</a><a id="btn-logout">Logout</a></div>
                        </div>
                        </div>';
            }
            ?>

        </div>
	</div>

	<div class="panel-contact">
		<div class="profile-head">Recent Activity's Friends</div>
		<ul id="contactList" class="contact-list"></ul>
	</div>
    <div class="panel-friend">
        <div class="profile-head">Friends List</div>
        <ul id="friend-list" class="friend-list">

        </ul>
    </div>
	<div class="panel-message">
		<div class="profile-head">Message</div>
        <div class="noConversation">No Conversation Selected. Please choose a friend in friend list to begin send message.</div>
        <div class="noMessage undisplayed">No Message displayed</div>
		<ul id="messageList" class="message-list"></ul>
		<div id="messageCompose" class="message-compose">
			<textarea class="message-input" id="message-input"></textarea>

			<div class="message-control">
				<div class="message-control-avt" style="background-image: url('images/resource/avt0.jpg')"></div>
				<div class="message-control-quote"></div>
                <div class="message-control-text"> Press enter to send message</div>
				<a id="btnSyn" class="message-btn-send">Get new message</a>

				<div class="message-control-emoticon">
					<div class="message-emo-popup">
						<ul class="emo-list">
							<li class="emo-item">:))</li>
							<li class="emo-item">:)</li>
							<li class="emo-item">:p</li>
							<li class="emo-item">:(</li>
							<li class="emo-item">;)</li>
							<li class="emo-item">:D</li>
							<li class="emo-item">B)</li>
							<li class="emo-item">X(</li>
							<li class="emo-item"></li>
							<li class="emo-item">:o</li>
							<li class="emo-item">:s</li>
							<li class="emo-item">:|</li>
							<li class="emo-item">:\</li>
						</ul>
					</div>
				</div>
			</div>

        </div>
    </div>


</div>
</div>
<?php
include 'common/login-register.php';
?>
</body>
</html>