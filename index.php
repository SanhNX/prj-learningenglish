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
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
	
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
<?php
	include 'common/menu.php';
        
?>
<div class="form">
	<div class="form-head">
		<span>Learning-English</span><span class="form-head-gray">Home</span>
	</div>
            <ul class="metro-list">
                <?php
                     $id = $_GET['category'];
                     echo '<script>alert("'.$id.'");</script>';
                     if ($id == null) {
                         $page = 1;
                     } else {
                         $page ++;
                     }
                     echo '<script>alert("'.$page.'");</script>';
                     $articleList = getArticleByCategoryid($id, $page);
                      echo '<script>alert("'.count($articleList).'");</script>';
                     $show = 0 ; 
                     for ($y = 0; $y < count($articleList); $y ++ ) {
                        $itemArticle = $articleList[$y];             
                        if ($show == 1 || $show == 5 || $show == 6 || $show == 9 ) {
                            echo '
                                <li class="metro-item large" style="background-image: url('.$itemArticle ->thumbnail.')">
                                    <div class="metro-bar">
                                        <a class="metro-bar-wrapper" href="">
                                            <div class=metro-title>
                                                    <span>'.$itemArticle ->title.'</span>
                                                    <div class="metro-title-duration">04:50</div>
                                            </div>
                                            <div class=metro-times>200</div>
                                            <div class=metro-level>999</div>
                                        </a>
                                    </div>
                                </li>
                            ';
                        }else {
                            echo '
                                <li class="metro-item" style="background-image: url('.$itemArticle ->thumbnail.')">
                                    <div class="metro-bar">
                                        <a class="metro-bar-wrapper" href="">
                                            <div class=metro-title>
                                                    <span>'.$itemArticle ->title.'</span>
                                                    <div class="metro-title-duration">04:50</div>
                                            </div>
                                            <div class=metro-times>200</div>
                                            <div class=metro-level>999</div>
                                        </a>
                                    </div>
                                </li>
                            ';
                        }
                        
                        if ($y ==  10) {
                            $show = 0 ;
                        } else {
                            $show ++;
                        }
                        
                     }
                ?>
    
		<li class="metro-item-clear">

		</li>
		<li class="metro-item-more"><span>Thêm</span>
		</li>
	</ul>
	<div class="control-bar">
		<div class=control-fb></div>
		<div class=control-contact>
			<div class="control-mess"></div>
			<div class="control-mail"></div>
		</div>
		<div class=control-rank-recent>
			<div class="control-rank-head"></div>
			<ul class="control-rank-list">
				<li class="control-rank-item">User 1</li>
				<li class="control-rank-item">User 2</li>
				<li class="control-rank-item">User 3</li>
				<li class="control-rank-item">User 4</li>
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