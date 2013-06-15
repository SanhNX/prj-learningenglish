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
    <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/admin-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-fieldselection.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.js"></script>
    <script type="text/javascript" src="scripts/admin-video.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
    <script type="text/javascript" src="scripts/date.js"></script>
    <script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
    <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="scripts/effect.js"></script>
    <script type="text/javascript" src="scripts/ajax-admin.js"></script>
</head>
<body>
<div class="page">
    <div class="nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="admin-video.php">Manager Video</a></li>
            <li class="nav-item"><a href="admin-user.php">Manager User</a></li>
            <li class="nav-item"><a href="#">...</a></li>
            <li class="nav-item"><a href="#">...</a></li>
            <li class="nav-item"><a href="#">...</a></li>
        </ul>
    </div>

    <div class="form-head">
        <span>Learning-English</span><span class="form-head-gray"> • Manager Video</span>

        <div class="form-head-task">
            <?php
            $avatar = 'images/resource/admin.gif';
            if (isset($_SESSION["admin_email"])) {
                echo '<div class="form-head-account">
                        <div class="form-head-account-wrapper">
                            <div class="form-head-profile">
                                <span>'.$_SESSION['admin_name'].'</span>
                                <span class="menu-popup-avt" style="background-image:url('.$avatar.')"></span>
                            </div>
                            <div class="form-head-logout"><a id="btn-admin-logout">Logout</a></div>
                        </div>
                    </div>';
            }  else {
                echo '<script type="text/javascript">warningAuthorize()</script>';
                exit();
            }
            ?>
        </div>
    </div>
    <div class="form">
        <div class="admin-panel">
            <div class="profile-head">Add New Video</div>
            <div class="admin-panel-content">

                <div class="admin-title">* Input URL and press "validate" button to fetch data video from youtube site & enable form input !</div>
                <div class="table-row gap">
                    <span class="admin-text-label">URL Address</span>
                    <input id="url" class="admin-text-input" type="text">
                    <input id="btn-validate" class="admin-button submit" type="button" value="Validate"/>
                </div>
                <div id="admin-video-title" class="video-title undisplayed"></div>
                <div class="video-player">
                    <iframe id="admin-player" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </div>
                <div id="keyword-panel" class="table-row min-gap undisplayed">
                    <div class="admin-text-label keyword inline">
                        <span> Keyword:</span>
                    </div>
                    <div class="admin-keyword">
                        <input id="admin-keyword-input" class="admin-text-input keyword" type="text" readonly="true"/>
                        <input id="btn-clear" class="admin-button keyword cancel" type="button" value="Clear"/>
                    </div>
                </div>
                <div id="rows-panel" class="table-row min-gap undisplayed">
                    <div class="admin-text-label new-row inline">
                        <div class="admin-time-row center">
                            <span class="admin-current-time">00:05:23 </span>
                        </div>
                        <div class="admin-time-row">
                            <span>Start: </span>
                            <input id="startTime" class="admin-table-text" type="text" value="00:00:00" readonly="true">
                            <a id="btn-getStartTime" class="admin-table-button time" id="admin-add-end-time" title="Press to get start time"></a>
                        </div>
                        <div class="admin-time-row">
                            <span>End: </span>
                            <input id="endTime" class="admin-table-text" type="text" value="00:00:00" readonly="true">
                            <a id="btn-getEndTime" class="admin-table-button time" id="admin-add-start-time" title="Press to get end time"></a>
                        </div>
                    </div>
                    <textarea id="admin-textarea-input" class="admin-text-input new-row area" maxlength="500" placeholder="Input caption text here..."></textarea>
                    <input id="btn-newRow" class="admin-button new-row add" type="button" value="Add"/>
                </div>
                <div id="hint-title" class="admin-title undisplayed">* Input hints list for keyword of current row !</div>
                <div id="hints-panel" class="table-row gap trend-right undisplayed">
                    <div class="admin-text-label hint"><span>Hints:</span></div>
                    <div class="admin-hint">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                        <input class="admin-text-input hint" type="text" value="" placeholder="Input hint here..." title="Input hints keyword">
                    </div>
                </div>
                <div id="select-cate">
                    <div class="admin-title">Category</div>
                    <div class="table-row gap">
                        <div class="admin-select">
                            <select id="value-cate">
                                <?php
                                $categoryList = getAllCategory();

                                for ($i = 0; $i < count($categoryList); $i++) {
                                    $item = $categoryList[$i];
                                    echo '<option value="'. $item->id .'">'. $item->name .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="select-level">
                    <div class="admin-title">Level</div>
                    <div class="table-row gap">
                        <div class="admin-select">
                            <select  id="value-level">
                                <option value="3">Hardly</option>
                                <option value="2">Medium</option>
                                <option value="1">Easy</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table id="tbContent-panel" class="admin-table gap undisplayed">
                    <thead class="admin-table-head">
                    <tr>
                        <td class="admin-table-cell">Head</td>
                        <td class="admin-table-cell-full">Content</td>
                        <td class="admin-table-cell">Control</td>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="admin-table-foot undisplayed">
                    <tr>
                        <td class="admin-table-cell-full" colspan="3">
                            <input class="admin-table-button prev unable" type="button" value="Cancel">
                            <input id="btn-save" class="admin-table-button next" type="button" value="Save">
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="admin-right-side">
            <div class="profile-head">Current video</div>
            <ul class="admin-list">
                <?php
                    $articleList = getAllArticle();

                    for($i = 0; $i < count($articleList); $i++){
                        $item = $articleList[$i];
                        echo '<li class="admin-item">
                                <span class="admin-item-name">'.$item->title.'</span>
                                <span class="admin-item-time">'.$item->duration.'</span>
                                <span class="admin-item-button edit"></span>
                                <span class="admin-item-button delete"></span>
                            </li>';
                    }
                ?>

            </ul>
        </div>
        <div class="admin-footer"></div>
    </div>
</div>
</body>
</html>