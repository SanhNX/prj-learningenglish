<?php session_start(); ?>
<!DOCTYPE html>
<?php
include 'DAO/connection.php';
include 'DTO/object.php';
include 'BLL/categoryBll.php';
include 'BLL/userBLL.php';
include 'BLL/activityHistoryBLL.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
    <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
</head>
<body>
<div class="page">
	<div class="menu">
		<ul class="menu-list">
			<li class="menu-item home"><a href="#">Trang ch?</a></li>
			<li class="menu-item menu-group acc" id="acc"><a href="#">Tài kho?n</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group cate" id="cate"><a href="#">Th? lo?i</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group day" id="day"><a href="#">BXH Ngày</a>

				<div class="menu-arrow"></div>
			</li>
			<li class="menu-item menu-group week" id="week"><a href="#">BXH Tu?n</a>

				<div class="menu-arrow"></div>
			</li>

		</ul>
		<div class="menu-popup" id="menu-popup">

			<div class="menu-popup-form acc">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">??ng nh?p</li>
					<li class="menu-popup-item">??ng kí</li>
				</ul>
			</div>
			<div class="menu-popup-form cate">
				<ul class="menu-popup-list">
					<li class="menu-popup-item">Gi?i trí</li>
					<li class="menu-popup-item">Âm nh?c</li>
					<li class="menu-popup-item">Làm th? nào</li>
					<li class="menu-popup-item">Khoa h?c</li>
					<li class="menu-popup-item">Th? gi?i t? nhiên</li>
					<li class="menu-popup-item">Th? thao</li>
					<li class="menu-popup-item">Tâm lý ng??i</li>
					<li class="menu-popup-item">Máy tính</li>
					<li class="menu-popup-item">Giao ti?p</li>
					<li class="menu-popup-item">Dành cho tr? em</li>
					<li class="menu-popup-item">Th? gi?i</li>
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
			<span>Bài viết</span><span class="form-head-gray"></span>
		</div>

		<div class="panel-video">
			<ul class="blog-list">
                            <ph
                            
                                <?php
                                    //if (isset($_GET['userid'])) {
                                        $id = 1;
                                        $itemUser = getInforUserById($id);
                                        
                                        echo '<li class="blog-item">
                                                    <div class="blog-item-info-img"></div>
                                                    <div class="blog-item-info">
                                                            <div class="blog-item-title">'.$itemUser->name.'</div>
                                                            <div class="blog-item-title">'.$itemUser->email.'</div>
                                                            <div class="blog-item-title">'.$itemUser->gender.'</div>
                                                            <div class="blog-item-title">'.$itemUser->joindate.'</div>
                                                            <div class="blog-item-title">'.$itemUser->status.'</div>
                                                            <div class="blog-item-title">Sum score ::::'.  countScore($id).'</div>    
                                                    </div>
                                            </li>
                                            ';
                                        
                                        
                                        
                                        
//                                    } else {
//                                        
//                                    }
                                
                                
                                
                                
                                ?>
                                 <div class=control-rank-recent>
                        <div class="control-rank-head"></div>
                        <ul class="control-rank-list">
                            <?php
                                $itemListUser = getInforTestofUser($id);
                                $asdsad = "   ";
                                for ($y = 0; $y < count($itemListUser); $y++) {
                                     $itemUserInforTest  = $itemListUser[$y];
                                     echo '<li class="control-rank-item">'.($y + 1).''.$asdsad.''.$itemUserInforTest->titleAr.''.$asdsad.''.$itemUserInforTest->score.' Ranking :::: '.$itemUserInforTest->ranking.'</li>';
                                    
                                }
                            ?>
                        </ul>
                    </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
				
				
			</ul>
		</div>
		<div class="panel-rank-blog">
		</div>

	</div>
</div>
</body>
</html>