<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/JSON.js"></script>
    <script type="text/javascript" src="scripts/video-control.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/main.js"></script>
</head>
<body>
<div class="page">
	<div class="menu">
		<ul class="menu-list">
			<li class="menu-item home"><a href="#">Trang chủ</a></li>
			<li class="menu-item menu-group acc" id="acc"><a href="#">Tài khoản</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group cate" id="cate"><a href="#">Thể loại</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group day" id="day"><a href="#">BXH Ngày</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group week" id="week"><a href="#">BXH Tuần</a>

				<div class="menu-arrow"></div>
			</li>

		</ul>
		<div class="menu-popup" id="menu-popup">

			<div class="menu-popup-form acc">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">Đăng nhập</li>
					<li class="menu-popup-item">Đăng kí</li>
				</ul>
			</div>
			<div class="menu-popup-form cate">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">Giải trí</li>
					<li class="menu-popup-item">Âm nhạc</li>
					<li class="menu-popup-item">Làm thế nào</li>
					<li class="menu-popup-item">Khoa học</li>
					<li class="menu-popup-item">Thế giới tự nhiên</li>
					<li class="menu-popup-item">Thể thao</li>
					<li class="menu-popup-item">Tâm lý người</li>
					<li class="menu-popup-item">Máy tính</li>
					<li class="menu-popup-item">Giao tiếp</li>
					<li class="menu-popup-item">Dành cho trẻ em</li>
					<li class="menu-popup-item">Thế giới</li>
					<li class="menu-popup-item">Khi yêu</li>
				</ul>
			</div>
			<div class="menu-popup-form day">
				<ul class="menu-popup-list special">
					<li class="menu-popup-item odd">Name1 2000</li>
					<li class="menu-popup-item">Name2 4000</li>
					<li class="menu-popup-item odd">Name3 2000</li>
					<li class="menu-popup-item">Name4 4000</li>
					<li class="menu-popup-item odd">Name5 2000</li>
					<li class="menu-popup-item">Name6 4000</li>
					<li class="menu-popup-item odd">Name7 2000</li>
					<li class="menu-popup-item">Name8 4000</li>
					<li class="menu-popup-item odd">Name9 2000</li>
					<li class="menu-popup-item">Name10 4000</li>
				</ul>
			</div>
			<div class="menu-popup-form week">
				<ul class="menu-popup-list special">
					<li class="menu-popup-item odd">Name1 2000</li>
					<li class="menu-popup-item">Name2 4000</li>
					<li class="menu-popup-item odd">Name3 2000</li>
					<li class="menu-popup-item">Name4 4000</li>
					<li class="menu-popup-item odd">Name5 2000</li>
					<li class="menu-popup-item">Name6 4000</li>
				</ul>
			</div>
		</div>

	</div>
	<div class="form">
		<div class="form-head">
			<span>Learning-English</span><span class="form-head-gray">Home</span>
		</div>

		<div class="panel-video">
			<div class="video-control">
				<div class="video-control-metro back5">Lùi 5 giây</div>
				<div class="video-control-metro skip5"> Tiến 5 giây</div>
				<div class="video-control-metro large scroll">Tự cuộn theo video</div>
				<div class="video-control-metro large score"> Kết quả
					<span class="video-control-score"></span></div>
			</div>
			<div class="video-player">
				<iframe id="player" width="100%" height="100%" src="http://www.youtube.com/embed/gnT8pD9eSCc" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="panel-play">
			<div class="play-keywords">
				<div class="play-keyword-item">keyword 0</div>
				<div class="play-keyword-item">keyword 1</div>
				<div class="play-keyword-item">keyword 2</div>
				<div class="play-keyword-item">keyword 3</div>
				<div class="play-keyword-item">keyword 4</div>
				<div class="play-keyword-item">keyword 5</div>
				<div class="play-keyword-item">keyword 6</div>
				<div class="play-keyword-item">keyword 7</div>
				<div class="play-keyword-item">keyword 8</div>
				<div class="play-keyword-item">keyword 9</div>
				<div class="play-keyword-item">keyword 0</div>
				<div class="play-keyword-item">keyword 1</div>
			</div>
			<div class="play-exam">
				<div class="play-exam-list">
					
				</div>
			</div>

			<div class="control-play-post">
				<div class="control-button finish">
				</div>
				<div class="control-button retry">
				</div>
				<div class="control-button error">
				</div>
				<div class="control-rank-recent">
					<div class="control-rank-head"></div>
					<ul class="control-rank-list">
						<li class="control-rank-item">User 1</li>
						<li class="control-rank-item">User 2</li>
						<li class="control-rank-item">User 3</li>
						<li class="control-rank-item">User 4</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</body>
</html>