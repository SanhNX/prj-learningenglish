<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/articleBLL.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
        
        <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="scripts/ajax-userprocess.js"></script>
        <script type="text/javascript" src="scripts/webtoolkit.aim.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
        <script type="text/javascript" src="scripts/date.js"></script>
        <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
        <script type="text/javascript" src="scripts/ajax-rankingdate.js"></script>
        <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="scripts/effect.js"></script>
        <script type="text/javascript" src="scripts/JSON.js"></script>
        <script type="text/javascript" src="scripts/ajax-index.js"></script>
        <script type="text/javascript" src="scripts/ajax-search.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="page">
            <?php
            include 'common/menu.php';
            ?>
            <div class="form">
                <div class="form-head">
                    <span>Learning-English</span><span class="form-head-gray">Home</span>
                    <div class="form-head-task">
                        // ------------ Check user login----------------//
                        <?php
                        if (isset($_SESSION["email"])) {
                            echo '<div class="form-head-account">
                                    <span>' . $_SESSION["email"] . '</span>
                                    <span class="menu-popup-avt" style="background-image:url(' . $_SESSION["avatar"] . ')"></span></div>';
                        }
                        ?>

                        <div class="form-head-search">
                            <div class="form-head-search-mask">
                                <input class="search-text" type="text" placeholder="Enter keyword ..." value=""/>
                                <div class="search-button"></div>

                            </div>
                        </div>

                    </div>
                </div>
                <ul class="metro-list" id ="listvideo">
                    //----------------- Show list video--------------------//
                    <?php
                    $id = null;

                    if (isset($_GET['category'])) {
                        $id = $_GET['category'];
                    }

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $articleList = getArticleByCategoryid($id, $page);
                    // echo '<script>alert("'.count($articleList).'");</script>';
                    $show = 0;
                    for ($y = 0; $y < count($articleList); $y++) {
//                        echo '<script>alert("'.$show.'-------'.$y.'");</script>';
                        $itemArticle = $articleList[$y];
//                        echo '<script>alert("'.$itemArticle->link.'");</script>';
                        // $video = getVideoContent($itemArticle->link);
//                        echo '<script>alert("************'.$video->length.'");</script>';
                        $currTime = $itemArticle->duration;

                        if ($show == 1 || $show == 5 || $show == 6 || $show == 9) {
                            echo '
                                <li class="metro-item large" style="background-image: url(' . $itemArticle->thumbnail . ')">
                                    <div class="metro-bar">
                                        <a name="redirect-play" class="metro-bar-wrapper" href="play.php?id=' . $itemArticle->idArticle . '" >
                                            <div class=metro-title>
                                                    <span>' . $itemArticle->title . '</span>
                                                    <div class="metro-title-duration">' . $currTime . '</div>
                                            </div>
                                            <div class=metro-times>' . $itemArticle->timesplay . '</div>
                                            <div class=metro-level>999</div>
                                        </a>
                                    </div>
                                </li>
                            ';
                        } else {
                            echo '
                                <li class="metro-item" style="background-image: url(' . $itemArticle->thumbnail . ')">
                                    <div class="metro-bar">
                                        <a name="redirect-play" class="metro-bar-wrapper" href="play.php?id=' . $itemArticle->idArticle . '">
                                            <div class=metro-title>
                                                    <span>' . $itemArticle->title . '</span>
                                                    <div class="metro-title-duration">' . $currTime . '</div>
                                            </div>
                                            <div class=metro-times>' . $itemArticle->timesplay . '</div>
                                            <div class=metro-level>999</div>
                                        </a>
                                    </div>
                                </li>
                            ';
                        }

                        if ($y == 10) {
                            $show = 0;
                        } else {
                            $show++;
                        }
                    }
                    echo '<li class="metro-item-clear">
                          </li>
                    ';

                    if (count($articleList) == 22) {
                        echo '<li class="metro-item-more" onclick="loadMore()">
                                <span id="more">More</span>
                                <input id="pagevalue" value="' . ($page + 1) . '" type="hidden">
                                <input id="idvalue" value="' . $id . '" type="hidden">    
                              </li>
                        ';
                    }
                    ?>



                </ul>
                <div class="control-bar">
                    <div class=control-fb></div>
                    <div class=control-contact>
                            <div class="control-mess flip-container" ontouchstart="this.classList.toggle('hover');">
                                    <div class="flipper">
                                            <div class="front">
                                                    <!-- front content -->
                                            </div>
                                            <div class="back">
                                                    <!-- back content -->
                                            </div>
                                        </div>
                                </div>
                                <div class="control-mail flip-container" ontouchstart="this.classList.toggle('hover');">
                                        <div class="flipper">
                                                <div class="front">
                                                        <!-- front content -->
                                                </div>
                                                <div class="back">
                                                        <!-- back content -->
                                                </div>
                                        </div>
                                </div>
                        </div>
                    <div class=control-rank-recent>
                        <div class="control-rank-head"></div>
                        <ul class="control-rank-list">
<!--                            <li class="control-rank-item">User 1111111111111111111111111111111111111111<a href="#"> thanh</a></li>
                            <li class="control-rank-item">User1111111111111111111111111111</li>
                            <li class="control-rank-item">User 31111111111111111111111</li>
                            <li class="control-rank-item">User 41111111111111111111111111</li>
                            <li class="control-rank-item">User 51111111111111111111111111111</li>
                            <li class="control-rank-item">User 61111111111111111111111111111</li>
                            <li class="control-rank-item">User 71111111111111111111111111111</li>
                            <li class="control-rank-item">User 81111111111111111111111111111</li>
                            <li class="control-rank-item">User 91111111111111111111111111111</li>
                            <li class="control-rank-item">User 101111111111111111111111111111</li>
                            <li class="control-rank-item">User 11111111111111111111111111111</li>-->
                        </ul>
                    </div>
                </div>
                <div class="fb-bar">
                    <div class="fb-like-box" data-href="http://www.facebook.com/voalearningenglish" data-width="1040" data-height="210" data-show-faces="true" data-stream="false" data-header="false"></div>
                </div>
            </div>
            <?php
            include 'common/login-register.php';
            ?>
    </body>
</html>