<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/articleBll.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-yii.css" rel="stylesheet" type="text/css"/>
        <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive-style.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
        <script type="text/javascript" src="scripts/ajax-userprocess.js"></script>
        <script type="text/javascript" src="scripts/webtoolkit.aim.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.js"></script>
        <script type="text/javascript" src="scripts/ajax-rankingdate.js"></script>
        <script type="text/javascript" src="scripts/video-control.js"></script>
        <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="scripts/effect.js"></script>
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script type="text/javascript" src="scripts/main.js"></script>
        <script type="text/javascript" src="scripts/date.js"></script>
        <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>

    </head>
    <?php
    $idArticle = $_GET["id"];
    echo '<body onload = "getDataYT(' . $idArticle . ')">';
    ?>
    <div id="fb-root"></div>
    <script>
        // Additional JS functions here
        window.fbAsyncInit = function() {
            FB.init({
                appId: "359445744178937",
                channelUrl: '//WWW.localhost/prjj-learningenglish/channel.html',
                status: true, // check login status
                cookie: true, // enable cookies to allow the server to access the session
                xfbml: true  // parse XFBML
            });
            // Additional init code here
            FB.getLoginStatus(function(response) {
                onFacebookReady();
                getFbUserData();
            });

        };
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
    </script>
    <div class="page">
        <?php
        include 'common/menu.php';
        ?>
        <div class="form">
            <div class="form-head">
                <span>Learning-English</span><span class="form-head-gray">Home</span>
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
                        <div class="video-social"></div>
                        <div class="video-comment">
                            <div class="fb-comments" data-href="' . $article->link . '" data-width="730" data-num-posts="5" ></div>
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
                <div class="control-rank-recent">
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
    <?php
    include 'common/login-register.php';
    ?>

</body>
</html>