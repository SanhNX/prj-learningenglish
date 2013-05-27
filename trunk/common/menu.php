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
				<li id="btnLogin" class="menu-popup-item">Log in</li>
				<li id="btnRegis" class="menu-popup-item">Register</li>
			</ul>
		</div>
		<div class="menu-popup-form cate">
			<ul class="menu-popup-list">
                <?php                                  
                    $categoryList = getAllCategory();

                    for ($i = 0; $i < count($categoryList); $i ++ ) {
                        $item = $categoryList[$i];
                        echo '
                            <a href="index.php?category=' .$item ->id. '" style="text-decoration: initial;">
                                <li class="menu-popup-item">' .$item ->name. '</li>
                            </a>
                            ';  
                    }

                ?>
			</ul>
                    
		</div>
	<div class="menu-popup-form day">
            <div class="menu-popup-head">
                <div class="menu-popup-calendar">
                    <div class="menu-popup-calendar-prev"></div>
                    <div class="menu-popup-calendar-current" id="popup-current-ranking-date">
<!--                        <i class="menu-popup-icon calendar-date"></i>
                        <span>6-5-2013 12-5-2013</span>-->
                    </div>
                    <div class="menu-popup-calendar-next"></div>
                </div>
            </div>
            <ul class="menu-popup-list special" id="popupRankingDate">
<!--                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">1</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name1 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">2</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name2 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">3</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name3 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">4</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name4 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">5</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name5 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">6</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name6 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">7</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name7 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">8</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name8 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">9</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name9 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">10</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name10 4000</span>
                </li>-->
            </ul>
        </div>
        <div class="menu-popup-form week">
            <div class="menu-popup-head">
                <div class="menu-popup-calendar">
                    <div class="menu-popup-calendar-prev"></div>
                    <div class="menu-popup-calendar-current" id="popup-current-ranking-week">
                        <i class="menu-popup-icon calendar-week" ></i>
                        <span>6-5-2013 12-5-2013</span>
                    </div>
                    <div class="menu-popup-calendar-next"></div>
                </div>
            </div>
            <ul class="menu-popup-list special" id="popupRankingWeek">
<!--                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">1</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name1 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">2</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name2 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">3</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name3 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">4</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name4 4000</span>
                </li>
                <li class="menu-popup-item odd">
                    <span class="menu-popup-num">5</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span><span>Name5 2000</span>
                </li>
                <li class="menu-popup-item">
                    <span class="menu-popup-num">6</span>
                    <span class="menu-popup-avt" style="background-image:url('images/resource/avt1.jpg')"></span><span>Name6 4000</span>
                </li>-->
            </ul>
        </div>
	</div>

</div>
