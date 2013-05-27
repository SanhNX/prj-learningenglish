<?php

include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/articleBll.php';

$param1 = $_POST['id'];
$param2 = $_POST['page'];
$itemList = getArticleByCategoryid($param1, $param2);
$girdView = "";
$show = 0;
for ($i = 0; $i < count($itemList); $i++) {
    $item = $itemList[$i];
     // $video = getVideoContent($item->link);
        $currTime = $item->duration;
    if ($i != 21) {

        if ($show == 1 || $show == 5 || $show == 6 || $show == 9) {
                $html = '
                    <li class="metro-item large" style="background-image: url(' . $item->thumbnail . ')">
                        <div class="metro-bar">
                            <a class="metro-bar-wrapper" href="">
                                <div class=metro-title>
                                        <span>' .$item->title . '</span>
                                        <div class="metro-title-duration">' . $currTime . '</div>
                                </div>
                                <div class=metro-times>'.$item->timesplay.'</div>
                                <div class=metro-level>999</div>
                            </a>
                        </div>
                    </li>
                ';
        } else {
            $html = '
                <li class="metro-item" style="background-image: url(' . $item->thumbnail . ')">
                    <div class="metro-bar">
                        <a class="metro-bar-wrapper" href="">
                            <div class=metro-title>
                                    <span>' . $item->title . '</span>
                                    <div class="metro-title-duration">' . $currTime . '</div>
                                </div>
                                <div class=metro-times>'.$item->timesplay.'</div>
                                <div class=metro-level>999</div>
                            </a>
                        </div>
                    </li>
                ';
            }

            if ($i == (count($itemList) - 1) ) {
                $addString = '<li class="metro-item-clear">
                </li>';
                $html = $html."".$addString;
            }
            
            if ($i == 10) {
                $show = 0;
            } else {
                $show++;
            }
        } else {
            $html = '
                <li class="metro-item" style="background-image: url(' . $item->thumbnail . ')">
                    <div class="metro-bar">
                        <a class="metro-bar-wrapper" href="">
                            <div class=metro-title>
                                    <span>' . $item->title . '</span>
                                    <div class="metro-title-duration">' . $currTime . '</div>
                            </div>
                            <div class=metro-times>'.$item->timesplay.'</div>
                            <div class=metro-level>999</div>
                        </a>
                    </div>
                </li>
                <li class="metro-item-clear">
                </li>
                <li class="metro-item-more">
                    <span id="more">More</span>
                    <input id="pagevalue" value="'.($param2 + 1).'" type="hidden">
                    <input id="idvalue" value="'.$param1.'" type="hidden">    
                  </li>
                ';
            }
    
        $girdView = $girdView . $html;
}

echo $girdView;
?>
                            