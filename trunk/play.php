<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/articleBLL.php';
include 'BLL/activityHistoryBLL.php';
include 'BLL/userBll.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-yii.css" rel="stylesheet" type="text/css"/>
        <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive-style.css" rel="stylesheet" type="text/css">
        <?php
            echo '<link rel="canonical" href="http://flewup.com/play.php?id='.$_GET["id"].'"/>';
        ?>
        <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
        <script type="text/javascript" src="scripts/facebookAPI.js"></script>
        <script type="text/javascript" src="scripts/ajax-userprocess.js"></script>
        <script type="text/javascript" src="scripts/webtoolkit.aim.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.js"></script>
        <script type="text/javascript" src="scripts/video-control.js"></script>
        <script type="text/javascript" src="scripts/ajax-rankingdate.js"></script>
        <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="scripts/effect.js"></script>
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script type="text/javascript" src="scripts/date.js"></script>
        <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>

    </head>
    <?php
    $idArticle = $_GET["id"];
    echo '<body onload = "getDataYT(' . $idArticle . ')">';
    ?>
    <div id="fb-root"></div>
    <script type = "text/javascript" >
        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.___gcfg = {
            lang: 'en-US'
        };
        (function() {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
    <div class="page">
        <?php
        include 'common/menu.php';
        ?>
        <div class="form">
            <span>Learning-English</span><span class="form-head-gray"> • Examination</span>
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
            <div class="panel-video">
                <div class="video-control">
                    <div class="video-control-metro back5">5 seconds</div>
                    <div class="video-control-metro skip5">5 seconds</div>
                    <div id="btnAutoScroll" class="video-control-metro large scroll">Auto Scroll</div>
                    <div class="video-control-metro large score"> Number of answers
                        <span class="video-control-score"></span></div>
                </div>
                <?php
                $article = getArticleById($idArticle);
                echo '<div class="video-title">' . $article->title . '</div>
                        <div class="video-player">
                            <iframe id="player" width="100%" height="100%" src="' . $article->link . '" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="video-social">
                            <div class="fb-like"><div class="fb-like" data-href="http://www.flewup.com/play.php?id=' . $article->idArticle . '" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div></div>
                            <div class="google-plus">
                                <g:plusone></g:plusone>
                            </div>
                        </div>
                        <div class="video-comment">
                            <div class="fb-comments" data-href="http://www.flewup.com/play.php?id=' . $article->idArticle . '" data-width="550" data-num-posts="5" ></div>
                        </div>';
                ?>
            </div>
            <div class="panel-play">
                <div class="play-keywords">
                    <!--<div class="play-keyword-item">keyword 0</div>-->
                </div>
                <div id="play-exam" class="play-exam">
                    <div id="play-exam-list" class="play-exam-list">

                    </div>
                </div>

                <div class="control-play-post">
                    <div id="btnSubmitVideoAnswer" class="control-button finish">Submit
                    </div>
                    <div id="btnReset" class="control-button retry">Try Again
                    </div>
                    <div id="btnOpenReportDialog" class="control-button error">Notify Error
                    </div>
                </div>
                <div class="control-rank-recent  play">
                    <div id="feedbackDialog" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Report Error</h3>
                        </div>
                        <div class="modal-body">
                            <p>So glad you have informed us of the fault site . All comments will be taken seriously and fix as quickly as possible .</p>
                            <form class="form-vertical" id="yw2" action="/play/197/video/start" method="post">
                                <label for="Report_url" class="required">Url <span class="required">*</span></label>
                                <input class="span4" style="color:black;" name="Report[url]" id="Report_url" type="text" maxlength="100"
                                       value="http://localhost/prj-learningenglish/play.php">
                                <label for="Report_message" class="required">Message <span class="required">*</span></label>
                                <textarea class="span4" name="Report[message]" id="Report_message"></textarea>
                                <p>Your email is required but can help us notify you in case of error recovery</p>
                                <label for="Report_email">Email</label>
                                <input class="span4" style="color:black;" name="Report[email]" id="Report_email" type="text" maxlength="100">
                            </form>
                        </div>
                        <div class="modal-footer">

                            <a href="#" class="btn btn-primary" id="btnSendReport"><i class="icon-ok icon-white"></i> Submit</a>
                            <a href="#" data-dismiss="modal" class="btn">Exit</a>

                        </div>

                    </div>
                    <div class="control-rank-head cup"></div>
                    <ul class="control-rank-list">
                        <li class="rank-row-item head">
                            <span href="" class="rank-row-name">Name</span>
                            <span class="rank-row-point">Points </span>
                            <span href="" class="rank-row-time">Date time</span>
                        </li>
                        <?php
                        $activityHistoryList = getActivityHistoryByArticleId($_GET['id']);
                        for ($i = 0; $i < count($activityHistoryList); $i++) {
                            $user = getInforUserById($activityHistoryList[$i]->userid);
//                            echo '<script>alert("' . $activityHistoryList[$i]->userid . '")</script>';
                            if ($i < 3)
                                echo '<li class="rank-row-item top">';
                            else
                                echo '<li class="rank-row-item">';
                            echo '<span class="rank-row-num">' . ($i + 1) . '</span>
                                        <span class="rank-row-avt" style="background-image:url(' . $user->avatar . ')"></span>
                                        <a href="profile.php?id=' . $user->id . '" class="rank-row-name">' . $user->name . '</a>
                                        <span class="rank-row-point">' . $activityHistoryList[$i]->score . '</span>
                                        <span class="rank-row-time">' . date_format(new DateTime($activityHistoryList[$i]->datesubmit), 'd/m/Y') . '</span>
                                    </li>';
                        }
                        ?>


                        <li class="rank-row-item more">
                            <span class="rank-row-button more">More</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <?php
    include 'common/login-register.php';
    ?>

</body>
</html>