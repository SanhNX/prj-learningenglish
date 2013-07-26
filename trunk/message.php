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
		<div class="profile-head">Recent Contact</div>
		<ul id="contactList" class="contact-list">
			<li class="contact-item active">
				<div class="contact-avt" style="background-image:url('images/resource/avt0.jpg')"></div>
				<div class="contact-info">
					<div class="contact-info-head">
						<span class="contact-name">H. Rackham</span>
						<span class="contact-time">12:03 AM</span>
					</div>
					<span class="contact-message">Sint occaecati cupiditate non provident, similique</span>
				</div>
			</li>
			<li class="contact-item">
				<div class="contact-avt" style="background-image:url('images/resource/avt1.jpg')"></div>
				<div class="contact-info">
					<div class="contact-info-head">
						<span class="contact-name">Mary</span>
						<span class="contact-time">12:03 AM</span>
					</div>
					<span class="contact-message">But in certain circumstances and owing to the claims
						of duty or the obligations :)</span>
				</div>
			</li>
			<li class="contact-item">
				<div class="contact-avt" style="background-image:url('images/resource/metro/m10.jpg')"></div>
				<div class="contact-info">
					<div class="contact-info-head">
						<span class="contact-name">Occur Ditate</span>
						<span class="contact-time">12:03 AM</span>
					</div>
					<span class="contact-message">Circumstances occur in which toil and pain can procure
						him some great pleasure.-_-</span>
				</div>
			</li>
			<li class="contact-item">
				<div class="contact-avt" style="background-image:url('images/resource/admin.gif')"></div>
				<div class="contact-info">
					<div class="contact-info-head">
						<span class="contact-name">Optio Cumque</span>
						<span class="contact-time">12:03 AM</span>
					</div>
					<span class="contact-message">To take a trivial example, which of us ever undertakes
						laborious physical exercise</span>
				</div>
			</li>
			<li class="contact-item">
				<div class="contact-avt" style="background-image: url('images/resource/avt0.jpg')"></div>
				<div class="contact-info">
					<div class="contact-info-head">
						<span class="contact-name">Tempore soluta</span>
						<span class="contact-time">12:03 AM</span>
					</div>
					<span class="contact-message">libero tempore, cum soluta nobis est eligendi optio cumque nihil
						impedit quo minus id quod maxime placeat facere possimus</span>
				</div>
			</li>
		</ul>
	</div>
	<div class="panel-message">
		<div class="profile-head">Message</div>
		<ul id="messageList" class="message-list"></ul>
		<div id="messageCompose" class="message-compose undisplayed">
			<textarea class="message-input" id="message-input"></textarea>

			<div class="message-control">
				<div class="message-control-avt" style="background-image: url('images/resource/avt0.jpg')"></div>
				<div class="message-control-quote"></div>
				<a id="btnSend" class="message-btn-send">Send</a>

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