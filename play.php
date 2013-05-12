<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
	<script type="text/javascript" src="scripts/JSON.js"></script>
    <script type="text/javascript" src="scripts/video-control.js"></script>
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/main.js"></script>
</head>
<body>
	<div id="fb-root"></div>
    <script>(function(d, s, id) {
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
	<div class="menu">
		<ul class="menu-list">
			<li class="menu-item home"><a href="#">Home</a></li>
			<li class="menu-item menu-group acc" id="acc"><a href="#">Account</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group cate" id="cate"><a href="#">Category</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group day" id="day"><a href="#">Ranking in day</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group week" id="week"><a href="#">Ranking in week</a>

				<div class="menu-arrow"></div>
			</li>

		</ul>
		<div class="menu-popup" id="menu-popup">

			<div class="menu-popup-form acc">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">Log in</li>
					<li class="menu-popup-item">Register</li>
				</ul>
			</div>
			<div class="menu-popup-form cate">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">Entertainment</li>
					<li class="menu-popup-item">Music</li>
					<li class="menu-popup-item">How to...</li>
					<li class="menu-popup-item">Science</li>
					<li class="menu-popup-item">The natural world</li>
					<li class="menu-popup-item">Sport</li>
					<li class="menu-popup-item">Psychology</li>
					<li class="menu-popup-item">Computer</li>
					<li class="menu-popup-item">Communication</li>
					<li class="menu-popup-item">For children</li>
					<li class="menu-popup-item">World</li>
					<li class="menu-popup-item">The Love</li>
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
				<div class="video-control-metro back5">5 seconds</div>
				<div class="video-control-metro skip5">5 seconds</div>
				<div class="video-control-metro large scroll">Auto Scroll</div>
				<div class="video-control-metro large score"> Result
					<span class="video-control-score"></span></div>
			</div>
			<div class="video-title"></div>
			<div class="video-player">
				<iframe id="player" width="100%" height="100%" src="http://www.youtube.com/embed/gnT8pD9eSCc" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="fb-comment">
				<div class="fb-comments" data-href="http://www.youtube.com/embed/gnT8pD9eSCc" data-width="470" data-num-posts="1"></div>
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
				<div class="control-button finish">Submit
				</div>
				<div class="control-button retry">Try Again
				</div>
				<div class="control-button error">Notify Error
				</div>
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