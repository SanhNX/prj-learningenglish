<?php

include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/articleBLL.php';
include '../BLL/getcontentBLL.php';

$keyword = $_POST['keyword'];
$itemList = searchByTitle($keyword);
$girdView = "";
$show = 0;
for ($i = 0; $i < count($itemList); $i++) {
    $item = $itemList[$i];
    
    $video = getVideoContent($item->link);
    $currTime = customizeTime($video->length);
    
    if ($show == 1 || $show == 5 || $show == 6 || $show == 9) {
            $html = '
                <li class="metro-item large" style="background-image: url(' . $item->thumbnail . ')">
                    <div class="metro-bar">
                        <a class="metro-bar-wrapper" href="">
                            <div class=metro-title>
                                    <span>' .$item->title . '</span>
                                    <div class="metro-title-duration">' . $currTime . '</div>
                            </div>
                            <div class=metro-times>200</div>
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
                                <div class=metro-times>200</div>
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
    $girdView = $girdView . $html;
}
echo $girdView;
?>
                            