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
				<li class="menu-popup-item">Register</li>
			</ul>
		</div>
		<div class="menu-popup-form cate">
			<ul class="menu-popup-list">
                            <?php                                  
                                // ----------------------------------
                                $categoryList = getAllCategory();

                                for ($i = 0; $i < count($categoryList); $i ++ ) {
                                    $item = $categoryList[$i];
                                    echo '
                                        <li class="menu-popup-item">' .$item ->name. '</li>
                                        ';  
                                }

                            ?>
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
