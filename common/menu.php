<div class="menu">
    <ul class="menu-list">
        <li class="menu-item home"><a href="index.php">Home</a></li>
        <li class="menu-item menu-group acc" id="acc"><a href="#">Account</a>

            <div class="menu-arrow"></div>
        </li>
        <li class="menu-item menu-group cate" id="cate"><a href="#">Category</a>

            <div class="menu-arrow"></div>
        </li>
        <li class="menu-item menu-group day" id="day"><a href="#">Today rankings</a>

            <div class="menu-arrow"></div>
        </li>
        <li class="menu-item menu-group week" id="week"><a href="#">Weekly rankings</a>

            <div class="menu-arrow"></div>
        </li>

    </ul>
    <div class="menu-popup" id="menu-popup">

        <div class="menu-popup-form acc">
            <ul class="menu-popup-list">
                <li id="btnLogin" class="menu-popup-item simple">Log in</li>
                <li id="btnRegis" class="menu-popup-item simple">Register</li>
            </ul>
        </div>
        <div class="menu-popup-form cate">
            <ul class="menu-popup-list">
                <?php
                $categoryListForEveryone = getAllCategoryForEveryone();
                $categoryListForKids = getAllCategoryForKids();
                echo '<li class="menu-popup-list-head">For Everyone</li>';
                for ($i = 0; $i < count($categoryListForEveryone); $i++) {
                    $item = $categoryListForEveryone[$i];
                    echo '<a href="index.php?category=' . $item->id . '" style="text-decoration: initial;">
                                <li class="menu-popup-item simple">' . $item->name . '</li>
                            </a>';
                }
                echo '<li class="menu-popup-list-head">For Kids</li>';
                for ($i = 0; $i < count($categoryListForKids); $i++) {
                    $item = $categoryListForKids[$i];
                    echo '<a href="index.php?category=' . $item->id . '" style="text-decoration: initial;">
                                <li class="menu-popup-item simple">' . $item->name . '</li>
                            </a>';
                }
                ?>
            </ul>

        </div>

        <div class="menu-popup-form day">
            <div class="menu-popup-head">
                <div class="menu-popup-calendar">
<!--                    <div class="menu-popup-calendar-prev"></div>-->
                    <div class="menu-popup-calendar-current" id="popup-current-ranking-date">
    <!--                        <i class="menu-popup-icon calendar-date"></i>
                            <input type="text" class="date-pick" value="5/28/2013"/>-->
                    </div>
<!--                    <div class="menu-popup-calendar-next"></div>-->
                </div>
            </div>
            <ul id="rank-list-day" class="menu-popup-list special">
                
            </ul>
        </div>
        <div class="menu-popup-form week">
            <div class="menu-popup-head">
                <div class="menu-popup-calendar">
<!--                    <div class="menu-popup-calendar-prev"></div>-->
                    <div id="popup-current-ranking-week" class="menu-popup-calendar-current">
                        <i class="menu-popup-icon calendar-week"></i>
                        <input readonly="readonly" type="text" id="currentweek" class="date-pick week" value=""/>
                    </div>
<!--                    <div class="menu-popup-calendar-next"></div>-->
                </div>
            </div>
            <ul id="rank-list-week" class="menu-popup-list special"></ul>
        </div>
    </div>

</div>
